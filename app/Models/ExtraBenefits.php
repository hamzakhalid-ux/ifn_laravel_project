<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraBenefits extends Model
{
    use HasFactory;
    protected $table = 'ifn_extra_benefits';
    protected $fillable = [
    'user_id','deal_id','package_id'
];
}
