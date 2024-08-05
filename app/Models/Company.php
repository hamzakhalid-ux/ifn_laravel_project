<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\ImageHelper;
use Exception;



class Company extends Model
{
    use HasFactory;
    protected $table = 'ifn_companies';
    protected $fillable = [
    'company_id',
    'company_name','company_country', 'company_phone','company_timezone','company_web','company_city','company_city_id',
    'company_lang','company_currency','company_profile','company_logo','web_id','user_id','twitter_link','linkdin_link','instagram_link','facebook_link'
];

    public function funds()
    {
        return $this->hasMany(Funds::class, 'fund_company' , 'company_id')->where('fund_status','confirmed');

    }

    public function company_country()
    {
        // return $this->hasMany(Funds::class, 'fund_company' , 'company_id')->where('fund_status','confirmed');
        return $this->hasone(Locations::class, 'short_title','company_country');

    }

    public function storeCompany($data)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                if (isset($data['company_logo']) && is_uploaded_file($data['company_logo'])){
                    $data['company_logo'] = (new ImageHelper)->uploadSingleImage($data['company_logo'],'media');
                }
                    $data['company_city_id'] = self::getCityid($data['company_city'] ,$data['company_country']);
                    $make_dic = self::makeDictionary($data);
                    Company::create($make_dic);
                DB::commit();
                return redirect('admin/company/list-companies')->with('message', 'success=Company Record Created Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('admin/company/list-companies')->with('message', 'danger=Something went Wrong'.$e->getMessage());


        }
    }

    public function updateCompany($data,$company_id)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                if (isset($data['company_logo']) && is_uploaded_file($data['company_logo'])){
                    $data['company_logo'] = (new ImageHelper)->uploadSingleImage($data['company_logo'],'media');
                }
                $data['company_city_id'] = self::getCityid($data['company_city'] ,$data['company_country']);
                $make_dic = self::makeDictionary($data);
                $post =Company::where('company_id',$company_id)->update($make_dic);

                DB::commit();
                return redirect('admin/company/list-companies')->with('message', 'success=Company Record Updated Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return  redirect('admin/company/list-companies')->with('message', 'danger='.$e->getMessage());

        }
    }

    public function makeDictionary($data)
    {
        $session_user = session()->get('userData');

        $data_dic['company_name'] = $data['company_name'] ?? '';
        $data_dic['company_country'] =$data['company_country'] ?? '';
        $data_dic['company_phone'] = $data['company_phone'] ?? '';
        $data_dic['company_timezone'] = (new Locations)->getRegionByCountry($data['company_country'] ?? '');
        $data_dic['company_web'] = $data['company_web'] ?? '';
        if(!empty($data['company_logo']))
        {
            $data_dic['company_logo'] = (!empty($data['company_logo'][0]['l']['name'])) ? $data['company_logo'][0]['l']['name'] : ($data['oldPostImage'] ?? '');
        }
        $data_dic['company_city'] = $data['company_city'] ?? '';
        $data_dic['company_city_id'] = $data['company_city_id'] ?? 0;
        $data_dic['company_lang'] = $data['company_lang'] ?? 0;
        $data_dic['company_currency'] = $data['company_currency'] ?? '';
        $data_dic['company_profile'] = $data['company_profile'] ?? 0;
        $data_dic['web_id'] = env("Web_id", 1);
        $data_dic['user_id'] = $session_user->user_id;
        $data_dic['twitter_link'] = $data['twitter_link'] ?? '';
        $data_dic['linkdin_link'] = $data['linkdin_link'] ?? '';
        $data_dic['instagram_link'] = $data['instagram_link'] ?? '';
        $data_dic['facebook_link'] = $data['facebook_link'] ?? '';
        return $data_dic;
    }

    public function getCityid($cityname ,$country_code)
    {
        if(!empty($cityname))
        {
            $city_record = Locations::where('level', 3)->where('title',strtolower($cityname))->first();
            if(empty($city_record))
            {
                $city_record = Locations::where('level', 1)->where('short_title',strtolower($country_code))->first();
                $location = Locations::create([
                    'title' => $cityname,
                    'parent_id' => $city_record['loc_id'],
                    'parent_title' => $city_record['title'],
                    'location_key' => strtolower($city_record['location_key'] . "/" . $cityname),
                    'level' => 2,
                    'status' => 1
                ]);
                return $location->loc_id;
            }
            else{
                return $city_record->loc_id;
            }
        }
    }

}
