<?php
namespace App\Http\Controllers\Backend\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Company\CompanyRequest;
use App\Models\Company;
use App\Models\Revenues;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Validator;

class CompanyController extends Controller{


    protected $company;

    public function __construct(Company $company){
        $this->company = $company;
    }

    public function getIndex(){
        $company_list = $this->company->get();

        return view('backend.company.index' , ['company_list' => $company_list]);
    }

    public function getAdd (){
        return view('backend.company.add');
    }

    public function postAdd(CompanyRequest $request){
        $array = [
            'company_name' => $request->input('company_name'),
            'tax_identification_number' => $request->input('tax_identification_number'),
            'phone_number' => $request->input('phone_number'),
            'email_address' => $request->input('email_address'),
            'address' => $request->input('address'),
            'person_charge' => $request->input('person_charge'),
            'website' => $request->input('website_address'),
            'account_number' => $request->input('account_number'),
            'bank_branch' => $request->input('bank_branch'),
            'person_charge_phone_number' => $request->input('person_charge_phone_number'),
            'person_charge_email_address' => $request->input('person_charge_email_address'),
            'active' => $request->input('active')
        ];
        $this->company->create($array);
        return redirect()->route('admin.company.index')->withFlashSuccess("Thêm công ty thành công");
    }

    public function getEdit ($id){

        $company = $this->company->find($id);

        if (empty($company)) abort(404);

        return view('backend.company.edit' , ['company' => $company]);
    }

    public function postEdit (Request $request,$id){

        $company = $this->company->find($id);

        $validator =  Validator::make($request->all(), [
            'company_name' => [
                'required',
                Rule::unique('company')->ignore($company->id)
            ],
            'address'  => 'required|max:191',
            'tax_identification_number'  => 'required|numeric',
            'person_charge'  => 'required|max:191',
            'person_charge_phone_number'  => 'required|numeric',
            'person_charge_email_address'  => 'required|email|max:191',
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator);

        if (empty($company)) abort(404);

        $company->company_name = $request->input('company_name');
        $company->tax_identification_number = $request->input('tax_identification_number');
        $company->phone_number = $request->input('phone_number');
        $company->email_address = $request->input('email_address');
        $company->address = $request->input('address');
        $company->person_charge = $request->input('person_charge');
        $company->website = $request->input('website_address');
        $company->account_number = $request->input('account_number');
        $company->bank_branch = $request->input('bank_branch');
        $company->person_charge_phone_number = $request->input('person_charge_phone_number');
        $company->person_charge_email_address = $request->input('person_charge_email_address');
        $company->active = $request->input('active');
        $company->save();

        return redirect()->route('admin.company.index')->withFlashSuccess('Chỉnh sửa thành công');
    }

    public function getShow($id){
        $company = $this->company->find($id);

       return view('backend.company.show',['company' => $company]);
    }

    public function getDelete($id){
        $company = $this->company->find($id);

        if (empty($company)){
            return abort(404);
        }

        $revenues = Revenues::where('company_id' , $company->id)->first();

        if (empty($revenues)){
            $company->delete();
            return redirect()->route('admin.company.index')->withFlashSuccess('Xóa công ty thành công');
        }

        return redirect()->route('admin.company.index')->withFlashDanger('Không thể xóa công ty này');
    }

}