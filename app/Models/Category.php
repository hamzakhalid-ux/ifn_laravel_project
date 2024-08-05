<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;

class Category extends Model
{
    protected $table = 'ifn_categories';
        protected $fillable = [
        'category_id',
        'title',
        'breadcrumb', 'parent_id' , 'parent_title', 'parent_breadcrumb','web_id',
        'cat_1','cat_2','cat_3','cat_4','cat_5','cat_6' ,'cat_level' ,'image','user_id'
    ];

    public function postmapper()
    {
        return $this->hasMany(PostCategory::class, 'category_id','category_id');

    }

    public function filtersetting()
    {
        return $this->hasone(FilterSetting::class, 'category_id','category_id');

    }



    public function storeCategory($data)
    {
        try{
            $old_record = (!empty($data['title'])) ? Category::where('title' ,$data['title'])->first() : [];
            if(!empty($data) && (empty($old_record) || !empty($data['old_cat_id'])))
            {
                $data = self::makeCategoryDirectory($data);
                $old_cat_id =$data['old_cat_id'];
                unset($data['old_cat_id']);
                unset($data['p_category']);
                Category::create($data);
              return redirect('admin/add-category')->with('message', 'success=Category Added Successfully');
            }
        }catch(Exception $e){
            return redirect('admin/add-category')->with('message', 'danger=Something went Wrong');
        }
    }

    public function updateCategory($data)
    {
        try{
            if(!empty($data) && !empty($data['old_cat_id']))
            {
                $data = self::makeCategoryDirectory($data);
                $old_cat_id =$data['old_cat_id'];
                unset($data['old_cat_id']);
                unset($data['p_category']);
                Category::where('category_id',$old_cat_id)->update($data);
              return redirect('admin/add-category')->with('message', 'success=Category Updated Successfully');
            }
        }catch(Exception $e){
            return redirect('admin/add-category')->with('message', 'danger=Something went Wrong');
        }
    }

    public function getAllCategory()
    {
        $session_user = session()->get('userData');


        if  (!empty($session_user) && in_array($session_user->role, [1, 2])) {
            $data = Category::when(!empty(request()->get('search_title')), function($q){
                return $q->where('title', 'like' , '%'. request()->get('search_title') . '%');
            })->get();
        } else {
            // $data = Category::where('user_id', $session_user->user_id)->get();
            $data = Category::when(!empty(request()->get('search_title')), function($q){
                return $q->where('post_title', 'like' , '%'. request()->get('search_title') . '%');
            })->get();
        }
        return (!empty($data) && count($data) > 0) ? $data->toArray() : [];
    }

    public function getCategory($id)
    {
        $data = Category::where('category_id',$id)->get();
        return (!empty($data) && count($data) > 0) ? $data : [];
    }

    public function makeCategoryDirectory($data)
    {
        $session_user = session()->get('userData');
        $p_cat_data = (!empty($data['p_category'])) ? Category::where('category_id' ,$data['p_category'])->first() : [];
        $cat_level = 0;
        $data['title'] = $data['title'] ?? '';
        $breadcrumb = ($p_cat_data['breadcrumb'] ?? '') . $data['title'];
        $data['breadcrumb'] =Str::slug($breadcrumb);
        $data['parent_id'] = $p_cat_data['category_id'] ?? 0;
        $data['web_id'] = env("Web_id", 1);
        $data['user_id'] = $session_user->user_id;
        $data['parent_title'] = $p_cat_data['title'] ?? '';
        $data['parent_breadcrumb'] = $p_cat_data['breadcrumb'] ?? 0;
        for($i=1;$i<=6;$i++)
        {
            // $data['cat_'.$i] = () ? $p_cat_data['cat_'.$i] : ($p_cat_data['category_id'] ?? '');
            if(!empty($p_cat_data['cat_'.$i]))
            {
                $data['cat_'.$i] = $p_cat_data['cat_'.$i];
                $cat_level = $i;
            }
            else{
                $data['cat_'.$i] =$p_cat_data['category_id'] ?? 0;
                $cat_level = $i;
                break;
            }
        }
        $data['cat_level'] = $cat_level ;

        return $data;
    }

    public function getAllPostCategory()
    {
        $categories = [];
        $categories= Category::with(['postmapper.postdetail' => function ($q) {
            $q->where('post_status', 'published');
        }])->whereHas('postmapper.postdetail', function ($q) {
            $q->where('post_status', 'published');
        })->get();
        // dd($categories->toArray());

        return (!empty($categories) && count($categories) > 0) ? $categories->toArray() : [];
    }
}
