<?php

namespace App\Helpers;

use Image;
// use DB;
use Illuminate\Support\Facades\DB;
// use Intervention\Image;

class ImageHelper
{

    private $imagesData = array();

    public function uploadTwoLayerMultipleImages($images, $dir)
    {
        $sizes = ['s' => 220, 'm' => 405, 'l' => 1000];
        $itrm = 0;
        foreach ($images as $layer => $imageObjects) {
            $explode = explode('_', $layer);
            $image_id = end($explode);

            $image_name = str_replace('images_', '', $layer);

            // foreach ($imageObjects as $key => $image) {

                $ext = $imageObjects->clientExtension();
                // $imageObject = $image;

                $this->getAllImageSizes($sizes, $imageObjects,  $image_id, $dir, $ext, '', $itrm);
                $itrm++;
            // }
        }
        return $this->imagesData;
    }

    public function uploadSingleImage($image, $dir, $name=null)
    {

        $sizes = ['l' => 600];

        $ext = $image->clientExtension();

        $this->getAllImageSizes($sizes, $image,  1, $dir, $ext, '', 0);

        return $this->imagesData;
    }

    public function getAllImageSizes($sizes, $imageObject, $image_id, $dir, $ext, $sku, $itrm)
    {

        $uploadingPath = $this->createDirectoryForUploading($dir, $sku);

        $createImageObj = Image::make($imageObject);

        $width  = (int) $createImageObj->width();
        $height = (int) $createImageObj->height();

        foreach ($sizes as $imgType => $size) {

            $image = Image::make($imageObject);

            $divide_width  = ($width / $size);
            $resize_width = $size;

            $resize_height = (int) ($height / $divide_width);
            $image = $image->resize($resize_width, $resize_height);

            $hash = md5(time() . $imgType . rand(0, 6));
            $upload_image_name = $sku . '_' . $image_id . '_' .  $hash  . '_' . $imgType . '.' . $ext;

            $this->imagesData[$itrm][$imgType]['name'] = $upload_image_name;
            $this->imagesData[$itrm][$imgType]['object_id'] = $image_id;

            $image->save($uploadingPath . $upload_image_name);
        }
    }

    public function createDirectoryForUploading($dir, $name)
    {
        $public_path = public_path('/');
        if (!is_dir($public_path . '/' . $dir)) {
            mkdir($public_path . '/' . $dir);
        }

        // if (!is_dir($public_path . '/' . $dir . '/' . $name)) {
        //     mkdir($public_path . '/' . $dir . '/' . $name);
        // }
        $upload_path = $public_path . $dir . '/';
        return $upload_path;
    }

    // public function removeImageByProductObjAndImageNumber($objProduct, $image_number)
    // {

    //     $directory = $objProduct->p_sku;
    //     $product_id = $objProduct->product_id;

    //     DB::beginTransaction();

    //     try {
    //         $image = DB::table('images as i')
    //             ->where('object_id', $product_id)
    //             ->where('object_type', 'product')->first();
    //         $image_id = $image->id;

    //         $image_sizes = DB::table('images_sizes as is')
    //             ->where('image_id', $image_id)
    //             ->where('image_number', $image_number)->get();
    //         $image_ids = [];



    //         foreach ($image_sizes as $key => $size) {
    //             if (file_exists(public_path('/products/' . $directory . '/' . $size->image_name))) {
    //                 unlink(public_path('/products/' . $directory . '/' . $size->image_name));
    //             }
    //             $image_ids[] = $size->id;
    //         }

    //         $removeImages = DB::table('images_sizes')->whereIn('id', $image_ids)->delete();
    //         DB::commit();

    //         // dd($image_sizes_id);
    //     } catch (\Throwable $th) {
    //         dd($th);
    //         DB::rollBack();
    //     }
    // }

    public function uploadImageAndReturnUrl($image, $dir, $name, $size)
    {
        $name = str_replace(" ", '-', $name);
        $name = str_replace("/", '', $name);

        $sizes = ['s' => 80, 'm' => 100, 'l' => 600];

        $ext = $image->clientExtension();


        $uploadingPath = $this->createDirectoryForUploading($dir, $name);


        $createImageObj = Image::make($image);
        $width  = (int) $createImageObj->width();
        $height = (int) $createImageObj->height();


        $image = Image::make($image);

        $divide_width  = ($width / $sizes[$size]);
        $resize_width = $sizes[$size];

        $resize_height = (int) ($height / $divide_width);
        $image = $image->resize($resize_width, $resize_height);

        $hash = md5(time() . $size . rand(0, 6));
        $upload_image_name = $name  . '_' .  $hash  . '_' . $size . '.' . $ext;

        $image->save($uploadingPath . $upload_image_name);

        return $upload_image_name;
    }

}
