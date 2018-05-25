<?php

namespace App\Http\Controllers\Backend\Appointment;

use App\Http\Controllers\Controller;

use App\Models\Company;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Validator, DateTime;

class AppointmentController extends Controller{

    protected $appointment;

    public function __construct(Appointment $appointment){
        $this->appointment = $appointment;
    }

    public function index(){

        $list_appointment = Appointment::where('active' , '<>' , 2)->orderBy('active' , 'desc')->get();

        return view('backend.appointment.index' , ['list_appointment' => $list_appointment]);
    }

    public function getAdd(){

        $list_company = Company::where('active' , 1)->orderBy('id' , 'desc')->get();

        if(sizeof($list_company) < 1){
            return redirect()->back()->withFlashWarning('Hiện chưa có công ty . Bạn hãy thêm công ty để đặt lịch hẹn');
        }

        return view('backend.appointment.add' , ['list_company' => $list_company]);

    }

    public function postAdd(Request $request){

        $validator = Validator::make($request->all() ,
                [
                    'place' => 'required',
                    'start_time' => 'required',
                    'finish_time' => 'required',
                    'title' => 'required'
                ]
            );
        $validator->setAttributeNames([
            'place' => 'Địa điểm',
            'start_time' => 'Thời gian bắt đầu',
            'finish_time' => 'Thời gian kết thúc',
            'title' => 'Tiêu đề'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->input('company') == 0){
            return redirect()->back()->withErrors(['error' => 'Bạn chưa chọn công ty đối tác . ' ])->withInput();
        }

        $company = Company::find($request->input('company'));

        $currentDate = new DateTime();
        $start = DateTime::createFromFormat('d-m-Y H:i', $request->input('start_time'));
        $finish = DateTime::createFromFormat('d-m-Y H:i', $request->input('finish_time'));

        if($start->getTimestamp() < ($currentDate->getTimestamp() - 60)){
            return redirect()->back()->withErrors(['error' => 'Thời gian bắt đầu hiện đang là quá khứ' ])->withInput();
        }

        if($finish->getTimestamp() <= $start->getTimestamp() ){
            return redirect()->back()->withErrors(['error' => 'Thời gian kết thúc không được nhỏ hơn thời gian bắt đầu' ])->withInput();
        }

        $array = [
            'user_id' => access()->user()->id,
            'title' => $request->input('title'),
            'place' => $request->input('place'),
            'start_time' => $start->format('Y-m-d H:i:s'),
            'finish_time' => $finish->format('Y-m-d H:i:s'),
            'active' => 0,
            'company_id' => $company->id,
        ];

        $add = Appointment::create($array);

        if ($add) {
            return redirect()->route('admin.appointment.index')->withFlashSuccess('Thêm lịch hẹn thành công.');
        } else {
            return redirect()->back()->withFlashDanger('Không thể thêm lịch hẹn.');
        }

    }

    public function getEdit(Request $request , $id){
        $appointment = Appointment::find($id);

        if (empty($appointment)) abort(404);

        if (!empty($appointment->approver_uid)){
            return redirect()->back()->withErrors(['error' => 'Cuộc hẹn này đã phê duyệt không được sửa']);
        }
        $list_company = Company::where('active' , 1)->orderBy('id' , 'desc')->get();

        return view('backend.appointment.edit' , ['appointment' => $appointment , 'list_company' => $list_company]);
    }

    public function postEdit(Request $request , $id){
        $appointment = Appointment::find($id);

        if (empty($appointment)) abort(404);

        $company = Company::find($request->input('company'));

        $currentDate = new DateTime();
        $start = DateTime::createFromFormat('d-m-Y H:i', $request->input('start_time'));
        $finish = DateTime::createFromFormat('d-m-Y H:i', $request->input('finish_time'));

        if($start->getTimestamp() < ($currentDate->getTimestamp() - 60)){
            return redirect()->back()->withErrors(['error' => 'Thời gian bắt đầu hiện đang là quá khứ' ])->withInput();
        }

        if($finish->getTimestamp() <= $start->getTimestamp()){
            return redirect()->back()->withErrors(['error' => 'Thời gian kết thúc không được nhỏ hơn thời gian bắt đầu' ])->withInput();
        }

        $appointment->title = $request->input('title');
        $appointment->place = $request->input('place');
        $appointment->start_time = $start->format('Y-m-d H:i:s');
        $appointment->finish_time = $finish->format('Y-m-d H:i:s');
        $appointment->company_id = $company->id;

        $appointment->save();

        return redirect()->route('admin.appointment.index')->withFlashSuccess('Sửa lịch hẹn thành công.');

    }

    public function getDelete($id){
        $appointment = Appointment::find($id);

        if (empty($appointment)) abort(404);

        if (!empty($appointment->approver_uid)){
            return redirect()->back()->withErrors(['error' => 'Cuộc hẹn này đã phê duyệt không được xóa.']);
        }
        $appointment->delete();

        return redirect()->back()->withFlashSuccess('Xóa cuộc hẹn thành công.');
    }

    public function getAgree($id){
        $appointment = Appointment::find($id);

        if (empty($appointment)) abort(404);

        $appointment->active = 1;

        $appointment->approver_uid = access()->user()->id;

        $appointment->save();

        return redirect()->route('admin.appointment.index')->withFlashSuccess('Đồng ý lịch hẹn ' . substr($appointment->title, 0, 25) . '... thành công.');
    }

    public function getCancel($id){
        $appointment = Appointment::find($id);

        if (empty($appointment)) abort(404);

        $appointment->active = 2;

        $appointment->approver_uid = access()->user()->id;

        $appointment->save();

        return redirect()->route('admin.appointment.all.cancel')->withFlashSuccess('Hủy bỏ lịch hẹn ' . substr($appointment->title, 0, 25) . ' ... thành công.');
    }

    public function getAllCancel(){
        $list_appointment = Appointment::where('active' , '=' , 2)->orderBy('id' , 'desc')->get();

        return view('backend.appointment.index' , ['list_appointment' => $list_appointment]);
    }
}