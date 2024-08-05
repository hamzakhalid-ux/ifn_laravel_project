<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingMapper extends Model
{
    use HasFactory;
    protected $table = 'ifn_setting_mapper';
    protected $fillable = [
    'setting_id',
    'session', 'object_id','object_type','web_id','user_id','status'
    ];

    public function settingpost()
    {
        return $this->hasOne(Post::class, 'post_id' , 'object_id');
    }

    public function settingcategory()
    {
        return $this->hasOne(Category::class, 'category_id' , 'object_id');
    }

}
