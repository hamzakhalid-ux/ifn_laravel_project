<?php

namespace App\Composers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\View\View;
use stdClass;

class EditMenuDataComposer {

    public function compose(View $view) {


        $menu_id = request('menu_id');
        $menu_data = (!empty($menu_id)) ? (new Menu)->getmenu($menu_id) : '';
        $menu_data[0]['db_menu_objects'] =$menu_data[0]['menu_objects'];
        if(!empty($menu_data[0]['menu_objects']))
        {
            $new_menu_obj=[];
            $sorted_order=[];
            foreach($menu_data[0]['menu_objects'] as $data)
            {
                $new_menu_obj[$data['object_type']][] =$data['object_id'];
                $var = new stdClass();
                $var->id = $data['object_id'];
                $var->type = $data['object_type'];
                $var->title = $data['object_title'];
                $sorted_order[] = $var;

            }
            $menu_data[0]['menu_objects'] = $new_menu_obj;
        }
        $view->with('menu_data', $menu_data)->with('sorted_order',$sorted_order);
    }

}
