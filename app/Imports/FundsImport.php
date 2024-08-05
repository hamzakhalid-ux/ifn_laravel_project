<?php
namespace App\Imports;

use App\Models\Company;
use App\Models\Funds;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FundsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $session_user = session()->get('userData');
        $companyName = $row['fund_company'] ?? 'temp company';
        $company = Company::where('company_name', $companyName)->first();

        // Check if fund_id is present for update
        if (isset($row['fund_id'])) {
            // Update existing record
            $fund = Funds::where('fund_id',$row['fund_id'])->first();
            if ($fund) {
                Funds::where('fund_id',$row['fund_id'])->update([
                    'fund_name' => $row['fund_name'],
                    'fund_country' => $row['fund_country'],
                    'investor_risk' => $row['investor_risk'],
                    'contact_person_name' => $row['contact_person_name'],
                    'contact_person_email' => $row['contact_person_email'],
                    'contact_person_phone' => $row['contact_person_phone'],
                    'fund_company' => $company->company_id ?? null,
                    'type_of_fund' => $row['type_of_fund'],
                    // 'fund_city' => $row['fund_city'],
                    'fund_expense_ratio' => $row['local_currency_amount'],
                    'fund_person_designation' => $row['fund_person_designation'],
                    'fund_last_update_date' => $row['fund_last_update_date'],
                    'web_id' => env("Web_id", 1),
                    'user_id' => $session_user->user_id,
                    'fund_status' => $row['fund_status'],
                    'fund_currency' =>$row['local_currency'],
                    'fund_manager' => $row['fund_manager'],
                    'fund_region' => $row['fund_region'],
                    'anum_usd' => $row['fund_anum_usd'],
                    'contact_person_landline' => $row['fund_contact_person_landline'],
                    'management_fee' => $row['fund_management_fee'],
                    'entry_fee' => $row['fund_entry_fee'],
                    'exit_fee' => $row['fund_exit_fee'],
                    'shariah_advisors' => $row['fund_shariah_advisors'],
                    'trustees' => $row['fund_trustees'],
                    'open_closed' => $row['fund_openclosed'],
                    'fund_website' => $row['fund_website'],
                    'asset_class' => $row['fund_asset_class'],
                    'launched_date' => $row['fund_launched_date'],
                    'fact_sheet_date' => $row['fund_fact_sheet_date'],
                    'return_1y' => $row['fund_return_1y'],
                    'return_3y' => $row['fund_return_3y'],
                    'return_5y' => $row['fund_return_5y'],
                    'return_ytd' => $row['fund_return_ytd'],
                    'domiciled' => $row['domiciled'],
                ]);
                return $fund;
            }
        }
        return new Funds([
            'fund_name' => $row['fund_name'],
            'fund_country' => $row['fund_country'],
            'investor_risk' => $row['investor_risk'],
            'contact_person_name' => $row['contact_person_name'],
            'contact_person_email' => $row['contact_person_email'],
            'contact_person_phone' => $row['contact_person_phone'],
            'fund_company' => $company->company_id ?? '',
            'type_of_fund' => $row['type_of_fund'],
            // 'fund_city' => $row['fund_city'],
            'fund_expense_ratio' => $row['local_currency_amount'],
            'fund_person_designation' => $row['fund_person_designation'],
            'fund_last_update_date' => $row['fund_last_update_date'],
            'web_id' => env("Web_id", 1),
            'user_id' => $session_user->user_id,
            'fund_status' => $row['fund_status'],
            // Add other fields for creation as needed
            'fund_currency' =>$row['local_currency'],
            'fund_manager' => $row['fund_manager'],
            'fund_region' => $row['fund_region'],
            'anum_usd' => $row['fund_anum_usd'],
            'contact_person_landline' => $row['fund_contact_person_landline'],
            'management_fee' => $row['fund_management_fee'],
            'entry_fee' => $row['fund_entry_fee'],
            'exit_fee' => $row['fund_exit_fee'],
            'shariah_advisors' => $row['fund_shariah_advisors'],
            'trustees' => $row['fund_trustees'],
            'open_closed' => $row['fund_openclosed'],
            'fund_website' => $row['fund_website'],
            'asset_class' => $row['fund_asset_class'],
            'launched_date' => $row['fund_launched_date'],
            'fact_sheet_date' => $row['fund_fact_sheet_date'],
            'return_1y' => $row['fund_return_1y'],
            'return_3y' => $row['fund_return_3y'],
            'return_5y' => $row['fund_return_5y'],
            'return_ytd' => $row['fund_return_ytd'],
            'domiciled' => $row['domiciled'],
        ]);
    }
}
