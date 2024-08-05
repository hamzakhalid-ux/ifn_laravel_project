<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\Page;
use Exception;

class PageController extends ViewComposingController
{
    //
    public function addPage(Request $request) {
        return $this->buildTemplate('addpage');
    }

    public function listPages(Request $request) {
        return $this->buildTemplate('listpages');
    }

    public function editPage(Request $request)
    {
        return $this->buildTemplate('editpage');
    }

    public function storePage(Request $request)
    {

        $request->validate([
            'page.page_title' => 'required',
            'page.page_order' => 'required',
            'page.page_status' => 'required',
        ]);
        $input =$request->all();
        if(isset($input['page']))
        {
            $responce = (new Page)->storePage($input['page']);
            return $responce;

        }
        return redirect('admin/post/add-post')->with('message', "danger=Something Went Wrong");

    }

    public function updatePage(Request $request)
    {

        $request->validate([
            'page.page_title' => 'required',
            'page.page_order' => 'required',
            'page.page_status' => 'required',
        ]);
        $input =$request->all();
        if(isset($input['page']))
        {
            $responce = (new Page)->updatePage($input['page'],$input['page']['page_id']);
            return $responce;

        }
        return redirect('admin/page/add-page')->with('message', "danger=Something Went Wrong");
    }

    public function deleteRecord(Request $request)
    {
        $data = $request->all();
        try{
            if(!empty($data['data_id']))
            {
                Page::where('page_id',$data['data_id'])->delete();
                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success', 'message' => "Page Deleted Successfully"]);
            }
            else{
                return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Page id is required"]);
            }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);

        }
    }
}
