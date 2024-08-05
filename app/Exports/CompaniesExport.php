<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompaniesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Company::select('company_id','company_name', 'company_country', 'company_phone', 'company_timezone'
        ,'company_web','company_city','company_lang','company_currency','company_profile')
        ->get();
    }
    public function headings(): array
    {
        return [
            'Company Id',
            'Company Name',
            'Company Country',
            'Company Phone',
            'Company TimeZone',
            'Company Website',
            'Company City',
            'Company Language',
            'Company Currency',
            'Company Profile',
        ];
    }
}
