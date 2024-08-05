<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Exception;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'ifn_tags';
    public $timestamps = false;
        protected $fillable = [
        'title',
        'slug', 'web_id','user_id'
    ];
    public function postmapper()
    {
        return $this->hasMany(PostTag::class, 'tag_id','id');

    }

    public function filtersetting()
    {
        return $this->hasone(FilterSetting::class, 'tag_id','id');

    }

    public function storetag($data)
    {
        try {
            if (!empty($data)) {
                $title = $data['title'] ?? '';
                $slug = Str::slug($title);

                // Check if a record with the given title exists
                $existingTag = Tag::where('title', $data['title'])->where('web_id',env("Web_id", 1))->first();

                if ($existingTag) {
                    return redirect('admin/list-tag')->with('message', 'success=Tag Already Exist');
                } else {
                    // Create a new record
                    $session_user =session()->get('userData');
                    Tag::create([
                        'title' => $title,
                        'slug' => $slug,
                        'web_id'=> env("Web_id", 1),
                        'user_id' => $session_user->user_id ?? '',
                        // Add other fields to create here
                    ]);
                    return redirect('admin/list-tag')->with('message', 'success=Tag Added Successfully');
                }
            }
        } catch (Exception $e) {
            return redirect('admin/list-tag')->with('message', 'danger=Something went wrong');
        }
    }

    public function getAlltags($id =null)
    {
        $session_user = session()->get('userData');
        $tags = [];

        if ((!empty($session_user)) &&in_array($session_user->role, [1, 2])) {
            $tags = Tag::when(!empty(request()->get('search_title')), function($q){
                return $q->where('title', 'like' , '%'. request()->get('search_title') . '%');
            })->get();
        } else {
            $tags = Tag::when(!empty(request()->get('search_title')), function($q){
                return $q->where('title', 'like' , '%'. request()->get('search_title') . '%');
            })->get();

            // $tags = Tag::where('user_id', $session_user->user_id)->get();
        }

        $data = (empty($id)) ?  $tags : Tag::where('id',$id)->get();
        return (!empty($data) && count($data) > 0) ? $data->toArray() : [];
    }

    public function updatetag($data)
    {
        try {
            if (!empty($data)) {
                $title = $data['title'] ?? '';
                $slug = Str::slug($title);
                Tag::where('id',$data['id'])->update([
                    'title' => $title,
                    'slug' => $slug,
                    'web_id'=> env("Web_id", 1),
                    // Add other fields to create here
                ]);
                return redirect('admin/list-tag')->with('message', 'success=Tag Added Successfully');
            }
        } catch (Exception $e) {

            return redirect('admin/list-tag')->with('message', 'danger=Something went wrong');

        }
    }

    public function getAllPosttags()
    {
        $tags = [];
        $tags= Tag::with(['postmapper.postdetail' => function ($q) {
            $q->where('post_status', 'published');
        }])->whereHas('postmapper.postdetail', function ($q) {
            $q->where('post_status', 'published');
        })->get();

        return (!empty($tags) && count($tags) > 0) ? $tags->toArray() : [];
    }

}
