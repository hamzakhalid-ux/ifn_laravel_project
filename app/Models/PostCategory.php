<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;
    protected $table = 'ifn_post_categories';
    protected $fillable = [
    'category_id',
    'post_id', 'web_id'
    ];



    public function categorytitle()
    {
        return $this->hasOne(Category::class, 'category_id' , 'category_id');
    }

    public function postdetail()
    {
        return $this->hasOne(Post::class, 'post_id' , 'post_id');
    }

}
