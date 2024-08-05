<?php
namespace App\Exports;

use App\Models\Funds;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // Import ShouldAutoSize
use PhpOffice\PhpSpreadsheet\Worksheet\Column; // Import Column
class FundsExport implements FromCollection, WithHeadings,WithColumnFormatting,ShouldAutoSize
{
    public function collection()
    {
        return Funds::with('companydetail')
            ->select(
                'fund_id',
                'fund_name',
                'fund_country',
                'investor_risk',
                'contact_person_name',
                'contact_person_email',
                'contact_person_phone',
                'fund_company',
                'type_of_fund',
                // 'fund_city',
                'fund_expense_ratio',
                'fund_person_designation',
                'fund_last_update_date',
                'fund_status',

                'fund_manager',
                'fund_region',
                'anum_usd',
                'contact_person_landline',
                'management_fee',
                'entry_fee',
                'exit_fee',
                'shariah_advisors',
                'trustees',
                'open_closed',
                'fund_website',
                'asset_class',
                'launched_date',
                'fact_sheet_date',
                'return_1y',
                'return_3y',
                'return_5y',
                'return_ytd',
                'domiciled',
                'fund_currency',
            )
            ->get()
            ->map(function ($fund) {
                return [
                    'Fund Id' => $fund->fund_id,
                    'Fund Manager' => $fund->fund_manager,
                    'Fund Name' => $fund->fund_name,
                    'Fund Website' => $fund->fund_website,
                    'Fund Region' => $fund->fund_region,
                    'Fund Country' => $fund->fund_country,
                    'Type of Fund' => $fund->type_of_fund,
                    'Fund Asset Class' => $fund->asset_class,
                    'Fund launched Date' => $fund->launched_date,
                    'Fund Fact Sheet Date' => $fund->fact_sheet_date,
                    'Local Currency' => $fund->fund_currency,
                    'Local Currency Amount' => $fund->fund_expense_ratio,
                    'Fund Anum Usd' => $fund->anum_usd,
                    'Fund Management Fee' => $fund->management_fee,
                    'Fund Entry Fee' => $fund->entry_fee,
                    'Fund Exit Fee' => $fund->exit_fee,
                    'Fund Return 1y' => $fund->return_1y,
                    'Fund Return 3y' => $fund->return_3y,
                    'Fund Return 5y' => $fund->return_5y,
                    'Fund Return ytd' => $fund->return_ytd,
                    'Fund Shariah Advisors' => $fund->shariah_advisors,
                    'Fund Trustees' => $fund->trustees,
                    'Fund Open/Closed' => $fund->open_closed,
                    'Domiciled' => $fund->domiciled,
                    'Fund Person Designation' => $fund->fund_person_designation,
                    'Contact Person Email' => $fund->contact_person_email,
                    'Contact Person Phone' => $fund->contact_person_phone,
                    'Fund Contact Person landline' => $fund->contact_person_landline,
                    'Fund Last Update Date' => $fund->fund_last_update_date,


                    //remaing not in sheet
                    'Investor Risk' => $fund->investor_risk,
                    'Contact Person Name' => $fund->contact_person_name,
                    'Fund Company' => $fund->companydetail->company_name ?? '', // Access the related company_name
                    'Fund Status' => $fund->fund_status,
                    // 'Fund City' => $fund->fund_city,

                ];
            });
    }

    public function headings(): array
    {
        return [
            'Fund Id',
            'Fund Manager',
            'Fund Name',
            'Fund Website' ,
            'Fund Region',
            'Fund Country',
            'Type of Fund',
            'Fund Asset Class',
            'Fund launched Date',
            'Fund Fact Sheet Date',
            'Local Currency',
            'Local Currency Amount',
            'Fund Anum Usd',
            'Fund Management Fee' ,
            'Fund Entry Fee' ,
            'Fund Exit Fee',
            'Fund Return 1y' ,
            'Fund Return 3y' ,
            'Fund Return 5y' ,
            'Fund Return ytd',
            'Fund Shariah Advisors',
            'Fund Trustees',
            'Fund Open/Closed',
            'Domiciled' ,
            'Fund Person Designation',
            'Contact Person Email',
            'Contact Person Phone',
            'Fund Contact Person landline' ,
            'Fund Last Update Date',

            //remaing not in sheet

            'Investor Risk',
            'Contact Person Name',
            'Fund Company',
            'Fund Status',
            // 'Fund City',

        ];
    }

    public function columnFormats(): array
    {
        // Set the column width to auto for all columns
        return [
            'A' => NumberFormat::FORMAT_GENERAL,
            'B' => NumberFormat::FORMAT_GENERAL,
            // Add more columns as needed
        ];
    }
}
