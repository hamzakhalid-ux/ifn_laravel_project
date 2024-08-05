<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

class Page extends Model
{
    use HasFactory;
    protected $table = 'ifn_pages';
        protected $fillable = [
        'page_id','page_class',
        'page_title','page_slug', 'page_date','page_status','comment_status','page_order',
        'page_image','page_template','page_parent_id','page_content','web_id','user_id','form_id'
    ];

    public function getAllPages()
    {
        $session_user = session()->get('userData');

        if (in_array($session_user->role, [1, 2])) {
            $data = Page::where('web_id',env("Web_id", 1))->get();
        } else {
            $data = Page::where('web_id',env("Web_id", 1))->where('user_id', $session_user->user_id)->get();
        }
        return (!empty($data) && count($data) > 0) ? $data->toArray() : [];
    }

    public function storePage($data)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                if (isset($data['image']) && is_uploaded_file($data['image'])){
                    $data['page_image'] = (new ImageHelper)->uploadSingleImage($data['image'],'page');
                }
                    $make_dic = self::makeDictionary($data);
                    Page::create($make_dic);
                DB::commit();
                return redirect('admin/page/list-pages')->with('message', 'success=Page Added Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('admin/page/list-pages')->with('message', 'danger=Something went Wrong'.$e->getMessage());


        }
    }

    public function updatePage($data, $page_id)
    {
        try{
            if(!empty($data))
            {
                if (isset($data['image']) && is_uploaded_file($data['image'])){
                    $data['page_image'] = (new ImageHelper)->uploadSingleImage($data['image'],'page');
                }
                $data = self::makeDictionary($data);
                unset($data['page_id']);
                Page::where('page_id',$page_id)->update($data);
              return redirect('admin/page/list-pages')->with('message', 'success=Page Updated Successfully');
            }
        }catch(Exception $e){
            return redirect('admin/page/list-pages')->with('message', 'danger=Something went Wrong');
        }
    }

    public function makeDictionary($data)
    {
        $session_user = session()->get('userData');

        $data_dic['page_title'] = $data['page_title'] ?? '';
        $data_dic['page_class'] = $data['page_class'] ?? '';
        $data_dic['page_slug'] = Str::slug($data['page_title']);
        $data_dic['page_parent_id'] = $data['page_parent_id'];
        $data_dic['page_content'] = $data['page_content'];
        $data_dic['page_date'] = $data['page_date'] ?? null;
        $data_dic['form_id'] = $data['form_id'] ?? null;
        $data_dic['page_image'] = (!empty($data['page_image'][0]['l']['name'])) ? $data['page_image'][0]['l']['name'] : ($data['oldPostImage'] ?? '');
        $data_dic['page_status'] = $data['page_status'] ?? '';
        $data_dic['page_order'] = $data['page_order'] ?? 0;
        $data_dic['page_template'] = $data['page_template'] ?? '';
        $data_dic['comment_status'] = $data['comment_status'] ?? 0;
        $data_dic['web_id'] = env("Web_id", 1);
        $data_dic['user_id'] = $session_user->user_id;
        return $data_dic;
    }


    public function getPage($page_id)
    {
        $data = Page::where('page_id',$page_id)->get();
        return (!empty($data) && count($data) > 0) ? $data->toArray() : [];

    }
}
