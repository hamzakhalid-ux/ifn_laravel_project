<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\ImagesSizes;
use Illuminate\Support\Facades\File;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MediaController extends ViewComposingController
{
    //
    public function mediapage(Request $request) {
        return $this->buildTemplate('medialibrary');
    }


    public function storeImages(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust allowed image formats and maximum file size as needed
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect('admin/media/library')->with('message', "danger=".$validator->errors());
        }
        $input =$request->all();
        if(isset($input['images']))
        {
            $upload_images = (new ImageHelper)->uploadTwoLayerMultipleImages($input['images'],'media');
            $response = self::uploadProductColorImages($upload_images);
            if( $response['status'] == 200)
            {
                return redirect('admin/media/library')->with('message', "success=Images Uploaded Successfully");
            }
            else{
                return redirect('admin/media/library')->with('message', "danger=Something Went Wrong");
            }

        }
        return redirect('admin/media/library')->with('message', "danger=Something Went Wrong");
    }



    public function uploadProductColorImages($upload_images)
    {

        $response = [];
        $add_image_data = [];
        $add_image_size_data = [];
        $number = 0;
        DB::beginTransaction();

        try {
            $session_user = session()->get('userData');
            $get_max_number = DB::table('ifn_images_sizes')->where('user_id',$session_user->user_id)->where('web_id', env('Web_id',1))->max('image_number');

            $number = !empty($get_max_number) ? $get_max_number : 0;
            $itr = 0;
            foreach ($upload_images as $images) {
                $number++;
                foreach ($images as $size => $image) {

                    // $add_image_size_data[$itr]['object_type'] = 'product_color';
                    // $add_image_size_data[$itr]['object_id'] =  $image['object_id'] ?? 0;
                    $add_image_size_data[$itr]['web_id'] = env("Web_id", 1);
                    $add_image_size_data[$itr]['user_id'] = $session_user->user_id;
                    $add_image_size_data[$itr]['image_name'] = $image['name'];
                    $add_image_size_data[$itr]['image_number'] = $number;
                    $add_image_size_data[$itr]['size_number'] = $size;
                    $itr++;
                }
            }

            DB::table('ifn_images_sizes')->insert($add_image_size_data);
            DB::commit();

            $response['status'] = 200;
            $response['message'] = 'Images Successfully Uploaded';
        } catch (\Throwable $th) {
            DB::rollBack();
            $response['status'] = 400;
            $response['message'] = 'Product Images not Uploaded, Pease Try Again';
        } catch (\Exception $e) {
            DB::rollBack();
            $response['status'] = 400;
            $response['message'] = 'Product Images not Uploaded, Pease Try Again';
        }

        return $response;
    }

    public function deleteImage(Request $request)
    {
        $data = $request->all();
        try{
            if(!empty($data['image_name']))
            {
                $filePath = public_path('media/' . $data['image_name']);
                // Check if the file exists
                if (File::exists($filePath)) {
                    // Delete the file
                    File::delete($filePath);
                    ImagesSizes::where('image_name',$data['image_name'])->delete();
                    return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success', 'message' => "Image Deleted Successfully"]);
                } else {
                    return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Image does not exist."]);
                }
            }
           else{
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Image name is required."]);
           }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);

        }
    }
}
