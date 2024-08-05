<?php

namespace App\Imports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompaniesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $session_user = session()->get('userData');
        $company = Company::where('company_id', $row['company_id'])->first();

        if ($company) {
            // If the company with the given company_id exists, update the existing record
            Company::where('company_id',$row['company_id'])->update([
                'company_name' => $row['company_name'],
                'company_country' => $row['company_country'],
                'company_phone' => $row['company_phone'],
                'company_timezone' => $row['company_timezone'],
                'company_web' => $row['company_website'],
                'company_city' => $row['company_city'],
                'company_lang' => $row['company_language'],
                'company_currency' => $row['company_currency'],
                'company_profile' => $row['company_profile'],
                'user_id' => $session_user->user_id,
                'company_city_id' => (new Company())->getCityid($row['company_city'], $row['company_country']),
                // Add more columns as needed
            ]);
        } else {
            // If the company with the given company_id doesn't exist, create a new record
            $company = new Company([
                'company_name' => $row['company_name'],
                'company_country' => $row['company_country'],
                'company_phone' => $row['company_phone'],
                'company_timezone' => $row['company_timezone'],
                'company_web' => $row['company_website'],
                'company_city' => $row['company_city'],
                'company_lang' => $row['company_language'],
                'company_currency' => $row['company_currency'],
                'company_profile' => $row['company_profile'],
                'web_id' => env("Web_id", 1),
                'user_id' => $session_user->user_id,
                'company_city_id' => (new Company())->getCityid($row['company_city'], $row['company_country']),
                // Add more columns as needed
            ]);

            $company->save();
        }

        return $company;
    }

}
