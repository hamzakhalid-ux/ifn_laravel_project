<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;


class Post extends Model
{
    use HasFactory;
    protected $table = 'ifn_posts';
    public $timestamps = false;
        protected $fillable = [
        'post_id',
        'post_title', 'post_date','post_status','comment_status','ping_status',
        'post_image','to_ping','pinged','post_content','web_id','user_id','form_id','videoName',
        'post_type','podcast','twitter_link','telegram_link','watsapp_link','linkdin_link','instagram_link',
        'facebook_link', 'sector', 'allow',
    ];

    public function post_category()
    {
        return $this->hasMany(PostCategory::class, 'post_id','post_id');
    }
    public function postform()
    {
        return $this->hasone(ContactForm::class, 'form_id','form_id');
    }

    public function post_tag()
    {
        return $this->hasMany(PostTag::class, 'post_id' , 'post_id');
    }

    public function post_location()
    {
        return $this->hasMany(PostLocations::class, 'post_id' , 'post_id');
    }

    public function userdetail()
    {
        return $this->hasone(User::class, 'user_id','user_id');
    }

    public function storePost($data)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                if (isset($data['image']) && is_uploaded_file($data['image'])){
                    $data['post_image'] = (new ImageHelper)->uploadSingleImage($data['image'],'post');
                }
                $make_dic = self::makeDictionary($data);
                $post =Post::create($make_dic);
                $tag_dic = self::childDictionary($data['tag'] ?? '', $post->id, env('Web_id',1) ,'tag_id');
                $cat_dic = self::childDictionary($data['category'] ?? '', $post->id, env('Web_id',1),'category_id');
                $loc_dic = self::childDictionary($data['location'] ?? '', $post->id, env('Web_id',1),'loc_id');

                $cat_result = (count($cat_dic)>0) ? PostCategory::insert($cat_dic) : '';
                $tag_result = (count($tag_dic)>0) ? PostTag::insert($tag_dic) : '';
                $tag_result = (count($tag_dic)>0) ? PostLocations::insert($loc_dic) : '';

                DB::commit();
                return redirect('admin/post/list-post')->with('message', 'success=Post Save Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return  redirect('admin/post/list-post')->with('message', 'danger='.$e->getMessage());

        }
    }

    public function updatePost($data,$old_post_id)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                if (isset($data['image']) && is_uploaded_file($data['image'])){
                    $data['post_image'] = (new ImageHelper)->uploadSingleImage($data['image'],'post');
                }
                $make_dic = self::makeDictionary($data);
                $post =Post::where('post_id',$old_post_id)->update($make_dic);
                $tag_dic = self::childDictionary($data['tag'] ?? '', $old_post_id, env('Web_id',1),'tag_id');
                $cat_dic = self::childDictionary($data['category'] ?? '', $old_post_id,env('Web_id',1),'category_id');
                $loc_dic = self::childDictionary($data['location'] ?? '', $old_post_id, env('Web_id',1),'loc_id');
                PostCategory::where('post_id',$old_post_id)->delete();
                PostCategory::where('post_id',$old_post_id)->delete();
                PostLocations::where('post_id',$old_post_id)->delete();
                $cat_result = (count($cat_dic)>0) ? PostCategory::insert($cat_dic) : '';
                $tag_result = (count($tag_dic)>0) ? PostTag::insert($tag_dic) : '';
                $tag_result = (count($tag_dic)>0) ? PostLocations::insert($loc_dic) : '';

                DB::commit();
                return redirect('admin/post/list-post')->with('message', 'success=Post Updated Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return  redirect('admin/post/list-post')->with('message', 'danger='.$e->getMessage());

        }
    }

    public function makeDictionary($data)
    {
        $session_user = session()->get('userData');
        $data_dic['post_title'] = $data['post_title'] ?? '';
        $data_dic['post_date'] = $data['post_date'] ?? date('Y-m-d H:i:s');
        $data_dic['post_status'] = $data['post_status'] ?? 'draft';
        $data_dic['comment_status'] = $data['comment_status'] ?? 0;
        $data_dic['ping_status'] = $data['ping_status'] ?? 0;
        $data_dic['post_image'] = (!empty($data['post_image'][0]['l']['name'])) ? $data['post_image'][0]['l']['name'] : ($data['oldPostImage'] ?? '');
        $data_dic['sticky'] = $data['sticky'] ?? 0;
        $data_dic['post_content'] = $data['post_content'] ?? '';
        $data_dic['form_id'] = $data['form_id'] ?? null;
        $data_dic['web_id'] = env("Web_id", 1);
        $data_dic['user_id'] = $session_user->user_id;
        $data_dic['post_type'] = $data['post_type'] ?? '';
        $data_dic['videoName'] = $data['videoName'] ?? '';
        $data_dic['podcast'] = $data['podcast'] ?? '';
        $data_dic['allow'] = $data['allow_article'] ?? '';
        $data_dic['twitter_link'] = $data['twitter_link'] ?? '';
        $data_dic['telegram_link'] = $data['telegram_link'] ?? '';
        $data_dic['watsapp_link'] = $data['watsapp_link'] ?? '';
        $data_dic['linkdin_link'] = $data['linkdin_link'] ?? '';
        $data_dic['instagram_link'] = $data['instagram_link'] ?? '';
        $data_dic['facebook_link'] = $data['facebook_link'] ?? '';
        $data_dic['sector'] = $data['sector'] ?? '';
        return $data_dic;
    }

    // public function tagDictionary($tags,$post_id,$web_id)
    // {
    //     if(!empty($tags))
    //     {
    //         $post_tags=[];
    //         foreach($tags as $index=>$tag)
    //         {
    //             $post_tags[$index]['tag_id'] = $tag;
    //             $post_tags[$index]['post_id'] = $post_id;
    //             $post_tags[$index]['web_id'] = $web_id;
    //         }
    //     }
    //     return (!empty($post_tags)) ? $post_tags : [];
    // }

    // public function catDictionary($categories,$post_id,$web_id)
    // {
    //     if(!empty($categories))
    //     {
    //         $post_categories=[];
    //         foreach($categories as $index=>$cat)
    //         {
    //             $post_categories[$index]['category_id'] = $cat;
    //             $post_categories[$index]['post_id'] = $post_id;
    //             $post_categories[$index]['web_id'] = $web_id;
    //         }
    //     }
    //     return (!empty($post_categories)) ? $post_categories : [];
    // }

    public function getAllPosts()
    {
        $session_user = session()->get('userData');

        if (in_array($session_user->role, [1, 2])) {
            $data = Post::where('web_id',env("Web_id", 1))->get();
        } else {
            $data = Post::where('web_id',env("Web_id", 1))->where('user_id', $session_user->user_id)->get();
        }
        return (!empty($data) && count($data) > 0) ? $data->toArray() : [];
    }

    public function getPost($post_id)
    {
        $data =Post::where('post_id',$post_id)->with('post_category','post_tag','post_location')->get();
        return (!empty($data) && count($data) > 0) ? $data->toArray() : [];

    }

    public function childDictionary($records,$post_id,$web_id,$used_at)
    {
        if(!empty($records))
        {
            $child_records=[];
            foreach($records as $index=>$cat)
            {
                $child_records[$index][$used_at] = $cat;
                $child_records[$index]['post_id'] = $post_id;
                $child_records[$index]['web_id'] = $web_id;
            }
        }
        return (!empty($child_records)) ? $child_records : [];
    }
}
