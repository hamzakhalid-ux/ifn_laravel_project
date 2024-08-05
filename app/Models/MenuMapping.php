<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuMapping extends Model
{
    use HasFactory;
    protected $table = 'ifn_menu_mapper';
    public $timestamps = false;
    protected $fillable = [
    'mapper_id',
    'menu_id','object_id', 'object_type','object_title','menu_order','parent_mapper_id','level','url'
    ];

    public function categorydata()
    {
        return $this->hasOne(Category::class, 'category_id' , 'object_id');

    }

    public function tagdata()
    {
        return $this->hasOne(Tag::class, 'id' , 'object_id');

    }

    public function locdata()
    {
        return $this->hasOne(Locations::class, 'loc_id' , 'object_id');

    }

    public function pagedata()
    {
        return $this->hasOne(Page::class, 'page_id' , 'object_id');

    }
}
