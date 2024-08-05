<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\PostTag;
use App\Models\Tag;
use Exception;

class TagController extends ViewComposingController
{
    //
    public function addTag(Request $request)
    {
        return $this->buildTemplate('tag');

    }

    public function storeTag(Request $request)
    {
        $request->validate([
            'tag.title' => 'required',
        ]);
        $input =$request->all();
        if(isset($input['tag']))
        {
            $responce = (new Tag)->storetag($input['tag']);
            return $responce;

        }
        return redirect('admin/list-tag')->with('message', 'danger=Something went wrong');
    }

    public function updateTag(Request $request)
    {
        $request->validate([
            'tag.title' => 'required',
        ]);
        $input =$request->all();
        if(isset($input['tag']))
        {
            $responce = (new Tag)->updatetag($input['tag']);

            return $responce;

        }
        return redirect('admin/list-tag')->with('message', 'danger=Something went wrong');
    }
    public function listTag()
    {
        return $this->buildTemplate('taglist');

    }

    public function deleteRecord(Request $request)
    {
        $data = $request->all();
        try{
            if(!empty($data['data_id']))
            {
                Tag::where('id',$data['data_id'])->delete();
                PostTag::where('id',$data['data_id'])->delete();
                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success', 'message' => "Tag Deleted Successfully"]);
            }
            else{
                return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Tag id is empty"]);
            }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);

        }
    }
}
