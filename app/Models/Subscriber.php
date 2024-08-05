<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;
    protected $table = 'ifn_subscriber';
    protected $fillable = [
    'user_id',
    'status', 'transaction_id','package_id','web_id'
    ];

    public function postdetail()
    {
        return $this->hasOne(User::class, 'user_id' , 'user_id');
    }
}
