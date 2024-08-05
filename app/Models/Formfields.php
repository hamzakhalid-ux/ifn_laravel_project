<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formfields extends Model
{
    use HasFactory;
    protected $table = 'ifn_form';
    protected $fillable = ['field_type'];
}
