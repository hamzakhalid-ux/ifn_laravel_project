<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\Menu;
use App\Models\MenuMapping;
use Illuminate\Http\Request;
use Exception;

class MenuController extends ViewComposingController
{
    //
    public function addMenu(Request $request) {
        return $this->buildTemplate('addmenu');
    }

    public function listMenus(Request $request) {
        return $this->buildTemplate('listmenu');
    }

    public function editMenu(Request $request)
    {
        return $this->buildTemplate('editmenu');
    }

    public function storeMenu(Request $request)
    {

        $request->validate([
            'menu.menu_title' => 'required',
            'menu.sorted_order' => 'required',

        ]);
        $input =$request->all();
        if(isset($input['menu']))
        {
            $responce = (new Menu)->storeMenu($input['menu']);
            return $responce;

        }
        return redirect('admin/menu/add-menu')->with('message', "danger=Something Went Wrong");

    }
    public function updateMenu(Request $request)
    {
        $request->validate([
            'menu.menu_title' => 'required',
            'menu.sorted_order' => 'required',
        ]);
        $input =$request->all();
        if(isset($input['menu']))
        {
            $responce = (new Menu)->updateMenu($input['menu'],$input['menu']['menu_id']);
            return $responce;

        }
        return redirect('admin/menu/add-menu')->with('message', "danger=Something Went Wrong");
    }

    public function deleteRecord(Request $request)
    {
        $data = $request->all();
        try{
            if(!empty($data['data_id']))
            {
                Menu::where('menu_id',$data['data_id'])->delete();
                MenuMapping::where('menu_id',$data['data_id'])->delete();
                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success', 'message' => "Page Deleted Successfully"]);
            }
            else{
                return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Menu id is required"]);

            }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);

        }
    }
}
