<?php

namespace App\Models;

use App\Http\Controllers\PaymentController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\PDFFile; // Assuming you have a model for storing PDF file details
use File;

class Funds extends Model
{
    use HasFactory;
    protected $table = 'ifn_funds';
    protected $fillable = [
        'fund_name','fund_currency','attached_file',
        'fund_country','investor_risk', 'contact_person_name','contact_person_email','contact_person_phone','fund_company',
        'type_of_fund','fund_city','fund_expense_ratio','fund_person_designation','fund_last_update_date','web_id','user_id', 'fund_status',
        'fund_manager','fund_region','anum_usd','contact_person_landline','management_fee','entry_fee','exit_fee','shariah_advisors','trustees',
        'open_closed','fund_website','asset_class','launched_date','fact_sheet_date','return_1y','return_3y','return_5y',
        'return_ytd','domiciled','suggest_company'
    ];

    public function companydetail()
    {
        return $this->hasone(Company::class, 'company_id','fund_company');

    }
    public function userDetail()
    {
        return $this->hasone(User::class, 'user_id','user_id');

    }
    public function loctitle()
    {
        return $this->hasOne(Locations::class, 'short_title' , 'fund_country');
    }
    public function storeFund($data)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                    if(!empty($data['attached_file']))
                    {
                        $pdfFile = $data['attached_file'];
                        $pdfFileName = 'saved_pdf_' . time() . '.' . $pdfFile->extension();
                        $data['attached_file'] = $pdfFileName;
                    }
                    $make_dic = self::makeDictionary($data);
                    $status=(!empty($pdfFileName)) ? $pdfFile->storeAs('pdf_files', $pdfFileName, 'public') : '';
                    Funds::create($make_dic);
                DB::commit();
                return redirect('admin/fund/list-funds')->with('message', 'success=Fund Created Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('admin/fund/list-funds')->with('message', 'danger=Something went Wrong'.$e->getMessage());


        }
    }


    public function updateFund($data,$fund_id)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                if(!empty($data['attached_file']))
                {
                    $pdfFile = $data['attached_file'];
                    $pdfFileName = 'saved_pdf_' . time() . '.' . $pdfFile->extension();
                    $data['attached_file'] = $pdfFileName;
                }
                $make_dic = self::makeDictionary($data);
                $status=(!empty($pdfFileName)) ? $pdfFile->storeAs('pdf_files', $pdfFileName, 'public') : '';
                Funds::where('fund_id',$fund_id)->update($make_dic);

                DB::commit();
                return redirect('admin/fund/list-funds')->with('message', 'success=Fund Updated Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return  redirect('admin/fund/list-funds')->with('message', 'danger='.$e->getMessage());

        }
    }

    public function makeDictionary($data)
    {
        $session_user = session()->get('userData');
        $convert_usd_amount = (!empty($data['fund_currency'])) ? (new PaymentController)->exchangeAmount($data['fund_currency'] ,'usd',$data['fund_expense_ratio']) : 0;

        $data_dic['fund_name'] = $data['fund_name'] ?? '';
        $data_dic['fund_country'] =$data['fund_country'] ?? '';
        $data_dic['investor_risk'] = $data['investor_risk'] ?? '';
        $data_dic['suggest_company'] = $data['suggest_company'] ?? '';
        if(!empty($data['attached_file']))
        {
            $data_dic['attached_file'] = $data['attached_file'] ?? '';
        }
        $data_dic['contact_person_name'] = $data['contact_person_name'] ?? '';
        $data_dic['contact_person_email'] = $data['contact_person_email'] ?? '';
        $data_dic['contact_person_phone'] = $data['contact_person_phone'] ?? '';
        $data_dic['fund_company'] = !empty($data['fund_company']) ? $data['fund_company'] : 25;
        $data_dic['type_of_fund'] = $data['type_of_fund'] ?? '';
        $data_dic['fund_city'] = $data['fund_city'] ?? '';
        $data_dic['fund_expense_ratio'] = $data['fund_expense_ratio'] ?? 0;
        $data_dic['fund_currency'] = $data['fund_currency'] ?? '';
        $data_dic['fund_person_designation'] = $data['fund_person_designation'] ?? '';
        $data_dic['fund_last_update_date'] = $data['fund_last_update_date'] ?? null;
        $data_dic['web_id'] = env("Web_id", 1);
        $data_dic['user_id'] = $session_user->user_id;

        $data_dic['fund_manager'] = $data['fund_manager'] ?? '';
        $data_dic['fund_region'] = (new Locations)->getRegionByCountry($data['fund_country'] ?? '');
        $data_dic['anum_usd'] = (!empty($data['anum_usd'])) ? $data['anum_usd'] : (number_format($convert_usd_amount, 2));
        $data_dic['contact_person_landline'] = $data['contact_person_landline'] ?? null;
        $data_dic['management_fee'] = $data['management_fee'] ?? 0;
        $data_dic['entry_fee'] = $data['entry_fee'] ?? 0;
        $data_dic['exit_fee'] = $data['exit_fee'] ?? 0;
        $data_dic['shariah_advisors'] = $data['shariah_advisors'] ?? '';
        $data_dic['trustees'] = $data['trustees'] ?? '';
        $data_dic['open_closed'] = $data['open_closed'] ?? '';
        $data_dic['fund_website'] = $data['fund_website'] ?? '';
        $data_dic['asset_class'] = $data['asset_class'] ?? '';
        $data_dic['launched_date'] = $data['launched_date'] ?? null;
        $data_dic['fact_sheet_date'] = $data['fact_sheet_date'] ?? null;
        $data_dic['return_1y'] = $data['return_1y'] ?? null;
        $data_dic['return_3y'] = $data['return_3y'] ?? null;
        $data_dic['return_5y'] = $data['return_5y'] ?? null;
        $data_dic['return_ytd'] = $data['return_ytd'] ?? null;
        $data_dic['domiciled'] = $data['domiciled'] ?? null;
        return $data_dic;
    }

}
