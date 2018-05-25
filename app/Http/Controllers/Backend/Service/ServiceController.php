<?php

namespace App\Http\Controllers\Backend\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Revenues;
use Validator;

class ServiceController extends Controller{

    private $service ;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function getIndex(){
        $service_list = $this->service->get();
        return view('backend.service.index' , ['service_list' => $service_list]);
    }

    public function getAdd(){
        return view('backend.service.add');
    }

    public function postAdd(Request $request){
        $validator = Validator::make($request->all(),
                [
                    'service_name' => 'required|max:255|unique:service,name',
                ]
            );

        $validator->setAttributeNames([
            'service_name' => 'Tên dịch vụ',
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $service = $this->service->create([
            'name' => $request->service_name,
            'active' => $request->active
        ]);

        if ($service){
            return redirect()->route('admin.service.index')->withFlashSuccess('Thêm dịch vụ thành công');
        }

        return redirect()->back()->withFlashDanger('Không thể thêm dịch vụ');
    }

    public function getEdit($id){
        $service = $this->service->find($id);

        if (empty($service)){
            abort(404);
        }

        return view('backend.service.edit' , ['service' => $service] );
    }

    public function postEdit(Request $request , $id){

        $service = $this->service->find($id);

        if (empty($service)){
            return redirect()->back()->withFlashDanger('Không thể sửa dịch vụ');
        }

        $validator = Validator::make($request->all(),
            [
                'service_name' => 'required|max:255|unique:service,name,'.$service->id,
            ]
        );

        $validator->setAttributeNames([
            'service_name' => 'Tên dịch vụ',
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $service->name = $request->service_name;
        $service->active = $request->active;
        $service->save();

        return redirect()->route('admin.service.index')->withFlashSuccess('Sửa dịch vụ thành công');
    }

    public function postDelete($id){
        $service = $this->service->find($id);

        if (empty($service)){
            return abort(404);
        }

        $revenues = Revenues::where('service_id' , $service->id)->first();

        if (empty($revenues)){
            $service->delete();
            return redirect()->route('admin.service.index')->withFlashSuccess('Xóa dịch vụ thành công');
        }

        return redirect()->route('admin.service.index')->withFlashDanger('Không thể xóa dịch vụ này');


    }
}