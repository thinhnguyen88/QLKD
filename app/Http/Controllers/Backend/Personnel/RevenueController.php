<?php

namespace App\Http\Controllers\Backend\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Revenues, Validator, DateTime;
use App\Models\Company;
use App\Models\Service;

class RevenueController extends Controller
{

    public function getIndex($uid)
    {
        $user_id = access()->user()->hasRoles(['Kỹ thuật', 'Trưởng phòng', 'Giám đốc']) ? $uid : access()->id();

        if ($user_id != $uid) {
            abort('404');
        }

        if ($uid) {
            $revenues = Revenues::where('uid', $uid)
                ->whereBetween('datetime', [date('Y-m-01 00:00:00'), date('Y-m-d 23:59:59')])
                ->orderBy('datetime', 'desc')
                ->get();

            return view('backend.personnel.revenues', compact('revenues'));
        }

        abort('404');
    }

    public function getAdd(Request $request)
    {

        $service_list = Service::where('active' , 1)->get();

        return view('backend.personnel.add_revenue' , ['service_list' => $service_list]);
    }

    public function getEdit(Request $request, $id = false)
    {
        if ($id)
        {
            $revenue = Revenues::findOrFail($id);

            $company = Company::find($revenue->company_id);

            $service = Service::find($revenue->service_id);

            if (access()->user()->hasRole('Kỹ thuật') || access()->id() == $revenue->uid) {
                return view('backend.personnel.edit_revenue', compact('revenue' ,'company','service'));
            }
        }

        abort('404');
    }

    public function postAdd(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company' => 'required|max:255',
            'company_id' => 'required',
            'datetime' => 'required',
            'profit' => 'required|numeric',
            'revenue' => 'required|numeric',
        ]);

        $validator->setAttributeNames([
            'company' => 'Công ty',
            'company_id'=>'Chọn lại Công ty',
            'datetime' => 'Ngày tháng',
            'profit' => 'Lợi nhuận',
            'revenue' => 'Doanh thu',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $datetime = DateTime::createFromFormat('d-m-Y H:i', $request->input('datetime'));

        $added = Revenues::create([
            'uid' => access()->id(),
            'company_id' => $request->input('company_id'),
            'datetime' => $datetime->format('Y-m-d H:i:s'),
            'profit' => $request->input('profit'),
            'revenue' => $request->input('revenue'),
            'service_id' => $request->input('service'),
        ]);


        if ($added) {
            return redirect()->route('admin.personnel.revenues.getEdit', ['id' => $added->id])->withFlashSuccess('Thêm doanh thu thành công.');
        } else {
            return redirect()->back()->withFlashDanger('Không thể thêm doanh thu.');
        }
    }

    public function postEdit(Request $request)
    {
        $revenue = Revenues::findOrFail($request->input('id'));

        $user_id = access()->user()->hasRole('Kỹ thuật') ? $revenue->uid : access()->id();

        if ($user_id != $revenue->uid) {
            abort('404');
        }

        $validator = Validator::make($request->all(), [
            'profit' => 'required|numeric',
            'revenue' => 'required|numeric',
            'reason_for_update' => 'required|max:500',
        ]);

        $validator->setAttributeNames([
            'profit' => 'Lợi nhuận',
            'revenue' => 'Doanh thu',
            'reason_for_update' => 'Lý do thay đổi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $revenue->revenue = $request->input('revenue');
        $revenue->reason_for_update = strip_tags($request->input('reason_for_update'));

        if ($revenue->save()) {
            return redirect()->back()->withInput()->withFlashSuccess('Thay đổi doanh thu thành công.');
        } else {
            return redirect()->back()->withFlashDanger('Không thể thay đổi doanh thu.');
        }
    }

    public function postAjaxSuggestion (Request $request ){
        $value = ltrim($request->value , "0");

        $company_list = Company::where(function($query) use ($value){
            $query->where('company_name', $value)->where('id', $value)->orWhere('id' , 'like' , '%'.$value.'%')->orWhere('company_name' , 'like' , '%'.$value.'%');
        })->where('active' , 1)->get();

        if (sizeof($company_list) > 0){
            $data_column = view('backend.personnel.includes.suggestion-ajax' , ['company_list' => $company_list]);

            return json_encode(['status' => true , 'data_column' => $data_column.""]);
        }

        return json_encode(['status' => false]);
    }

    public function postAjaxSuggestionDetail (Request $request){
        $id = $request->id;
        $company = Company::find($id);

        if (empty($company)){
            return json_encode(['status' => false]);
        }

        return json_encode(['status' => true , 'company' => $company]);
    }
}