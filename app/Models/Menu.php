<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'ifn_menu';
    protected $fillable = [
    'menu_id',
    'menu_title','menu_slug', 'web_id','parent_menu_id','json_menu_items','user_id'
    ];

    public function menu_objects()
    {
        return $this->hasMany(MenuMapping::class, 'menu_id','menu_id');
    }

    public function storeMenu($data)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                $sortingData = json_decode($data['sorted_order']);
                $make_dic = self::makeDictionary($data);
                $menu =Menu::create($make_dic);
                unset($data['menu_title']);
                $object_data = self::storeMenuItems($sortingData, $menu->id);
                // $result = (count($object_data)>0) ? MenuMapping::insert($object_data) : '';

                DB::commit();
                return redirect('admin/menu/list-menu')->with('message', 'success=Menu Save Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('admin/menu/list-menu')->with('message', 'danger=Something went Wrong'.$e->getMessage());


        }
    }
    public function makeDictionary($data)
    {
        $session_user = session()->get('userData');

        $data_dic['menu_title'] = $data['menu_title'] ?? '';
        $data_dic['menu_slug'] = Str::slug($data['menu_title']);
        $data_dic['json_menu_items'] = $data['sorted_order'];
        $data_dic['web_id'] = env("Web_id", 1);
        $data_dic['user_id'] = $session_user->user_id;
        return $data_dic;
    }

    public function objectDictionary($data,$menu_id)
    {
        if(!empty($data))
        {
            $menu_obj = [];
            $key = 0;
            foreach($data as $index=>$objects)
            {
                foreach($objects as $obj )
                {
                    $menu_obj[$key]['menu_id'] = $menu_id;
                    $menu_obj[$key]['object_id'] = $obj;
                    $menu_obj[$key]['object_type'] = $index;
                    $key++;
                }
            }
        }
        return (!empty($menu_obj)) ? $menu_obj : [];
    }

    public function orderObjectDictionary($data,$menu_id)
    {
        if(!empty($data))
        {
            $menu_obj = [];
            foreach($data as $index=>$obj)
            {
                $menu_obj[$index]['menu_id'] = $menu_id;
                $menu_obj[$index]['object_id'] = $obj->id;
                $menu_obj[$index]['object_type'] = $obj->type;
                $menu_obj[$index]['object_title'] = $obj->title;
            }
        }
        return (!empty($menu_obj)) ? $menu_obj : [];
    }

    public function getAllMenus()
    {

        $session_user = session()->get('userData');
        if (in_array($session_user->role, [1, 2])) {
            $data = Menu::where('web_id',env("Web_id", 1))->with('menu_objects')->get();
        } else {
            $data = Menu::where('web_id',env("Web_id", 1))->where('user_id', $session_user->user_id)->with('menu_objects')->get();
        }
        return (!empty($data) && count($data) > 0) ? $data->toArray() : [];
    }

    public function getmenu($menu_id)
    {
        $data = Menu::where('menu_id',$menu_id)->with('menu_objects')->get();
        return (!empty($data) && count($data) > 0) ? $data->toArray() : [];

    }

    public function updateMenu($data,$menu_id)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                $make_dic = self::makeDictionary($data);
                $sortingData = json_decode($data['sorted_order']);
                $post =Menu::where('menu_id',$menu_id)->update($make_dic);
                MenuMapping::where('menu_id',$menu_id)->delete();
                $object_data = self::storeMenuItems($sortingData, $menu_id);


                DB::commit();
                return redirect('admin/menu/list-menu')->with('message', 'success=Menu Updated Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return  redirect('admin/menu/list-menu')->with('message', 'danger='.$e->getMessage());

        }
    }

    function storeMenuItems($menuItems,$menu_id, $parentId = null ,$menu_level = 0) {

        foreach ($menuItems as $item) {
            $menuItem = new MenuMapping();
            $menuItem->menu_id = $menu_id;
            $menuItem->object_id = ($item->data_type == 'custom_links') ? null :$item->data_id;
            $menuItem->url = ($item->data_type == 'custom_links') ? $item->href : null ;
            $menuItem->object_type = $item->data_type;
            $menuItem->object_title = $item->text;
            $menuItem->parent_mapper_id = $parentId;
            $menuItem->level = $menu_level + 1;
            $menuItem->parent_mapper_id = $parentId; // Set the parent ID

            // Save the menu item to the database
            $menuItem->save();

            // Check if the current item has children
            if (isset($item->children) && is_array($item->children)) {
                // Recursively store the children with the current item's ID as the parent
                self::storeMenuItems($item->children,$menu_id ,$menuItem->id , $menuItem->level);
            }
        }
    }

}
