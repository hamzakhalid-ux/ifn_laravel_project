<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesSizes extends Model
{
    use HasFactory;
    protected $table = 'ifn_images_sizes';
    public $timestamps = false;
    protected $fillable = [
    'web_id',
    'image_name', 'image_number','size_number'
    ];

    public function getAllImages()
    {

        $session_user = session()->get('userData');
        if (in_array($session_user->role, [1, 2])) {
            $data = ImagesSizes::where('web_id',env("Web_id", 1))->get();
        } else {
            $data = ImagesSizes::where('web_id',env("Web_id", 1))->where('user_id', $session_user->user_id)->get();
        }
        return (!empty($data) && count($data) > 0) ? $data->toArray() : [];
    }

}
