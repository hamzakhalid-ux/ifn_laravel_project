<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactFormFields extends Model
{
    use HasFactory;
    protected $table = 'ifn_contact_form_fields';
    protected $fillable = [
    'form_id',
    'field_id','field_type', 'field_label','field_class','field_required','field_name'];
}
