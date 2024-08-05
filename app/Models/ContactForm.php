<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class ContactForm extends Model
{
    use HasFactory;

    protected $table = 'ifn_contact_form';
    protected $fillable = ['form_name','web_id','user_id'];

    public function form_fields()
    {
        return $this->hasMany(ContactFormFields::class, 'form_id','form_id');
    }


    public function storeForm($data, $formname)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                $session_user = session()->get('userData');

                $form =ContactForm::create(['form_name' =>$formname,'web_id'=>env("Web_id", 1) ,
                'user_id'=> $session_user->user_id]);

                $make_dic = self::makeDictionary($data,$form->id);
                ContactFormFields::insert($make_dic);

                DB::commit();
                return redirect('admin/form/list-forms')->with('message', 'success=Form Created Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('admin/form/list-forms')->with('message', 'danger=Something went Wrong'.$e->getMessage());


        }
    }

    public function updateForm($data, $formname,$form_id)
    {
        try {
            if (!empty($data)) {
                DB::beginTransaction();
                $session_user = session()->get('userData');

                $form = ContactForm::where('form_id',$form_id)->update(['form_name'=>$formname]);

                $make_dic = self::makeDictionary($data,$form_id);
                ContactFormFields::where('form_id',$form_id)->delete();

                ContactFormFields::insert($make_dic);

                DB::commit();
                return redirect('admin/form/list-forms')->with('message', 'success=Form Updated Successfully');

            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('admin/form/list-forms')->with('message', 'danger=Something went Wrong'.$e->getMessage());


        }
    }

    public function makeDictionary($data,$form_id)
    {
        $make_dic=[];
        foreach($data as $index=>$obj)
        {
            $data_dic[$index]['form_id'] = $form_id;
            $data_dic[$index]['field_id'] = $obj['field_id'];
            $data_dic[$index]['field_type'] = $obj['field_type'] ?? '';
            $data_dic[$index]['field_name'] = $obj['field_name'] ?? '';
            $data_dic[$index]['field_label'] = $obj['field_label'] ?? '';
            $data_dic[$index]['field_class'] = $obj['field_class'] ?? '';
            $data_dic[$index]['field_required'] = (int) $obj['field_required'];

        }

        return $data_dic;
    }
}
