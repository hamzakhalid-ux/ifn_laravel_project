<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;
    protected $table = 'ifn_post_tags';
    protected $fillable = [
    'tag_id',
    'post_id', 'web_id'
    ];
    public function tagtitle()
    {
        return $this->hasOne(Tag::class, 'id' , 'tag_id');
    }

    public function postdetail()
    {
        return $this->hasOne(Post::class, 'post_id' , 'post_id');
    }
}
