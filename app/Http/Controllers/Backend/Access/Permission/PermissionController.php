<?php

namespace App\Http\Controllers\Backend\Access\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Access\Permission\Permission;


class PermissionController extends Controller
{

    public function getPermission(Request $request){

        $permission = Permission::paginate(10);

        if (empty($request->page)) {
            $request->page = 1;
        }

        $id = ($request->page - 1) * $permission->perPage();

        return view('backend.access.permission.permission',compact('permission','id'));
    }


    public function getAdd(){

        return view('backend.access.permission.add_permission');

    }


    public function postAdd(Request $request){

        $validator = Validator::make($request->all(), ['permission' => 'max:32|unique:permissions,display_name']);

        $validator->setAttributeNames([
            'permission' => 'Quyền',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->withErrors($validator)->withInput();

        }else{
            $permission = new Permission;
            $permission->display_name = $request->permission;
            $permission->name = str_slug($request->permission);
            $permission->save();
            return redirect('admin/access/permission')->withFlashSuccess('Thêm quyền thành công.');
        }
    }


    public function getDelete(Request $request)
    {
        Permission::destroy($request->id);
        return redirect('admin/access/permission');
    }


    public function getEdit($id){

        $per = Permission::find($id);
        return view('backend.access.permission.edit_permission',compact('per'));
    }


    public function postEdit(Request $request){

        $validator = Validator::make($request->all(), ['permission' => 'max:32|unique:permissions,display_name,'.$request->id]);

        $validator->setAttributeNames([
            'permission' => 'Quyền',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->withErrors($validator)->withInput();

        }else{
            $permission = Permission::find($request->id);
            $permission->display_name = $request->permission;
            $permission->name = str_slug($request->permission);
            $permission->save();
            return redirect('admin/access/permission')->withFlashSuccess('Sửa quyền thành công.');

        }
    }

}