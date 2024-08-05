<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;
    protected $table = 'ifn_user_details';
    protected $fillable = [
    'user_id', 'salutation', 'company','designation','country','region','city',
    'phone_number','direct_line','code_and_sector','job_code'
    ];

    public function loctitle()
    {
        return $this->hasOne(Locations::class, 'short_title' , 'country');
    }
}
