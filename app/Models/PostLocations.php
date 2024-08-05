<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostLocations extends Model
{
    use HasFactory;
    protected $table = 'ifn_post_locations';
    protected $fillable = [
    'loc_id',
    'post_id', 'web_id'
    ];
    public function loctitle()
    {
        return $this->hasOne(Locations::class, 'loc_id' , 'loc_id');
    }

    public function postdetail()
    {
        return $this->hasOne(Post::class, 'post_id' , 'post_id');
    }
}
