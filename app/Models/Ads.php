<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Ads extends Model
{
    use HasFactory;
    protected $table = 'ifn_ads';
    protected $fillable = [
    'ad_id','ad_type','ad_status',
    'ad_title','ad_image', 'web_id','user_id','ad_link'
];


    public function storeAds($data)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                if (isset($data['ad_image']) && is_uploaded_file($data['ad_image'])){
                    $data['ad_image'] = (new ImageHelper)->uploadSingleImage($data['ad_image'],'ads_images');
                }
                    $make_dic = self::makeDictionary($data);
                    Ads::create($make_dic);
                DB::commit();
                return redirect('admin/ads/list-ads')->with('message', 'success=Ads Created Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('admin/ads/list-ads')->with('message', 'danger=Something went Wrong'.$e->getMessage());


        }
    }


    public function updateAds($data)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                if (isset($data['ad_image']) && is_uploaded_file($data['ad_image'])){
                    $data['ad_image'] = (new ImageHelper)->uploadSingleImage($data['ad_image'],'ads_images');
                }
                    $make_dic = self::makeDictionary($data);
                    Ads::where('ad_id',$data['ad_id'])->update($make_dic);

                DB::commit();
                return redirect('admin/ads/list-ads')->with('message', 'success=Ads Update Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('admin/ads/list-ads')->with('message', 'danger=Something went Wrong'.$e->getMessage());


        }
    }

    public function makeDictionary($data)
    {
        $session_user = session()->get('userData');

        $data_dic['ad_type'] = $data['ad_type'] ?? '';
        $data_dic['ad_title'] = $data['ad_title'] ?? '';
        $data_dic['ad_link'] = $data['ad_link'] ?? '';
        $data_dic['ad_status'] = $data['ad_status'] ?? '';
        if(!empty($data['ad_image']))
        $data_dic['ad_image'] = $data['ad_image'][0]['l']['name'] ?? '';

        $data_dic['web_id'] = env("Web_id", 1);
        $data_dic['user_id'] = $session_user->user_id;
        return $data_dic;
    }


}
