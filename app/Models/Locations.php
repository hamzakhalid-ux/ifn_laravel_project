<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Locations extends Model
{
    use HasFactory;
    protected $table = 'ifn_locations';
    protected $fillable = [
    'loc_id',
    'title','short_title', 'parent_id','parent_title','breadcrumb_ids','breadcrumb_title',
    'location_key','loc1','level','status','web_id','user_id'
];

    public function postmapper()
    {
        return $this->hasMany(PostLocations::class, 'loc_id','loc_id');

    }

    public function filtersetting()
    {
        return $this->hasone(FilterSetting::class, 'loc_id','loc_id');

    }
    protected $primaryKey = 'loc_id';

    public function parent_detail()
    {
        return $this->hasone(Locations::class, 'parent_id','loc_id');
    }

    public function storeLocation($data)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                self::getCityid($data['location_title'] ,$data['location_parent_id']);
                DB::commit();
                return redirect('admin/location/list-locations')->with('message', 'success=Location Created Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('admin/location/list-locations')->with('message', 'danger=Something went Wrong'.$e->getMessage());


        }
    }

    public function getCityid($cityname ,$location_parent_id)
    {
        if(!empty($cityname))
        {
            $city_record = Locations::where('loc_id', $location_parent_id)->first();
            if(!empty($city_record))
            {
                $location = new Locations();
                    $location->title = $cityname;
                    $location->parent_id = $city_record['loc_id'];
                    $location->parent_title = $city_record['title'];
                    $location->location_key = strtolower($city_record['location_key'] . "/" . $cityname);
                    $location->level = 2;
                    $location->status = 1;

                    $numberOfLocFields = 8;
                // Loop through and set loc fields
                for ($i = 1; $i <= $numberOfLocFields; $i++) {
                    $fieldName = 'loc' . $i;
                    $location->$fieldName = (!empty($city_record[$fieldName]) ? $city_record[$fieldName] : $city_record['loc_id']);
                    // Break out of the loop if the condition is met
                    if (empty($city_record[$fieldName])) {
                        break;
                    }
                }
                $location->save();
            }
            else{
                $location = Locations::create([
                    'title' => $cityname,
                    'location_key' => strtolower( "/" . $cityname),
                    'level' => 1,
                    'status' => 1
                ]);
            }
        }
    }

    public function updateLocation($data)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                self::updatecity($data['loc_id'] ,$data['location_title'] ,$data['location_parent_id']);
                DB::commit();
                return redirect('admin/location/list-locations')->with('message', 'success=Location Update Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('admin/location/list-locations')->with('message', 'danger=Something went Wrong'.$e->getMessage());


        }
    }

    public function updatecity($loc_id,$cityname ,$location_parent_id)
    {
        if(!empty($cityname))
        {
            $city_record = Locations::where('loc_id', $location_parent_id)->first();

                $location = Locations::find($loc_id);
                $location->title = $cityname;
                $location->parent_id = $city_record['loc_id'] ?? null;
                $location->parent_title = $city_record['title'] ?? null;
                $location->location_key = (!empty($city_record['location_key'])) ? strtolower($city_record['location_key'] . "/" . $cityname) : $cityname;
                $location->level = !empty($city_record['level']) ?$city_record['level'] :  1;
                $location->status = 1;

                $numberOfLocFields = 8;
            // Loop through and set loc fields
            for ($i = 1; $i <= $numberOfLocFields; $i++) {
                $fieldName = 'loc' . $i;
                $location->$fieldName = (!empty($city_record[$fieldName]) ? $city_record[$fieldName] : $city_record['loc_id'] ?? null);
                // Break out of the loop if the condition is met
                if (empty($city_record[$fieldName])) {
                    break;
                }
            }
            $location->save();

        }
    }
    public function getRegionByCountry($country)
    {
        return Locations::where('short_title', $country)->value('region');
    }

}
