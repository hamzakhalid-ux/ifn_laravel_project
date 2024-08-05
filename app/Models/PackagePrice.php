<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagePrice extends Model
{
    use HasFactory;
    protected $table = 'if_package_prices';
    protected $fillable = [
    'number_of_subscriber',
    'price', 'currency','web_id','user_id'
    ];

}
