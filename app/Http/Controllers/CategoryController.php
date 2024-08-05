<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuMapping;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Tag;
use Exception;


class CategoryController extends ViewComposingController
{
    //
    public function addCategory(Request $request)
    {
        return $this->buildTemplate('category');

    }
    public function storeCategory(Request $request)
    {
        $request->validate([
            'category.title' => 'required',
        ]);
        $input =$request->all();
        if(isset($input['category']))
        {
            $responce = (new Category)->storeCategory($input['category']);
            return $responce;

        }
        return redirect('admin/add-category')->with('message', "danger=Something Went Wrong");

    }
    public function listCategory()
    {
        return $this->buildTemplate('categorylist');

    }

    public function updateCategory(Request $request)
    {
        $request->validate([
            'category.title' => 'required',
        ]);
        $input =$request->all();
        if(isset($input['category']))
        {
            $responce = (new Category)->updateCategory($input['category']);
            return $responce;
        }
        return redirect('admin/add-category')->with('message', "danger=Something Went Wrong");

    }

    public function deleteRecord(Request $request)
    {
        $data = $request->all();
        try{
            if(!empty($data['data_id']))
            {
                Category::where('category_id',$data['data_id'])->delete();
                PostCategory::where('category_id',$data['data_id'])->delete();
                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success', 'message' => "Category Deleted Successfully"]);
            }
           else{
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Category id is required."]);
           }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);

        }
    }
}
