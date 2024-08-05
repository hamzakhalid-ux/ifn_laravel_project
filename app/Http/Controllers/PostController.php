<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use Exception;

class PostController extends ViewComposingController
{
    //
    public function addPost(Request $request) {
        return $this->buildTemplate('addpost');
    }

    public function listPost(Request $request) {
        return $this->buildTemplate('listpost');
    }
    public function storePost(Request $request)
    {
        $request->validate([
            'post.post_title' => 'required',
            'post.category' => 'required',
        ]);
        $input =$request->all();
        if(isset($input['post']))
        {
            $responce = (new Post)->storePost($input['post']);
            return $responce;

        }
        return redirect('admin/post/add-post')->with('message', "danger=Something Went Wrong");

    }
    public function editpost(Request $request)
    {
        return $this->buildTemplate('editpost');
    }

    public function updatePost(Request $request)
    {
        $request->validate([
            'post.post_title' => 'required',
            'post.category' => 'required',
        ]);
        $input =$request->all();
        if(isset($input['post']))
        {
            $responce = (new Post)->updatePost($input['post'],$input['old_post_id']);
            return $responce;

        }
        return redirect('admin/post/add-post')->with('message', "danger=Something Went Wrong");
    }

    public function deleteRecord(Request $request)
    {
        $data = $request->all();
        try{

            if(!empty($data['data_id']))
            {
                Post::where('post_id',$data['data_id'])->delete();
                PostTag::where('post_id',$data['data_id'])->delete();
                PostCategory::where('post_id',$data['data_id'])->delete();
                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success', 'message' => "Post Deleted Successfully"]);
            }else{
                return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Post id is required"]);

            }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);

        }
    }
}
