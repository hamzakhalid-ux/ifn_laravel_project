<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultDeals extends Model
{
    use HasFactory;
    protected $table = 'ifn_default_deals';
    protected $fillable = [ 'package_id','deal_name' ,'step','deal_description'];

}
