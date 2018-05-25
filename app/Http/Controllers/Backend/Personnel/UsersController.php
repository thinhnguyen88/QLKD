<?php

namespace App\Http\Controllers\Backend\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use Validator;
use App\Models\Access\User\User;
use App\Models\Access\Role\Role;
use App\Models\Goals;
use App\Models\Company;
use App\Helpers\OfficeHelper;
use DB;
use App\Helpers\Backend\Utilities;
use Ixudra\Curl\Facades\Curl;

class UsersController extends Controller
{

    public function getIndex()
    {
        $sales = DB::table('users')->select('id')->get()->toArray();
        foreach ($sales as $list){
            $role_user = DB::table('role_user')->where('user_id',$list->id)->get();
            if($role_user->isEmpty()){
                DB::table('role_user')->insert(
                    ['user_id' => $list->id, 'role_id' => 3]
                );
            }
        }
//        user mới tạo gán mặc định quyền là nhân viên

        $users = Role::find(3)->users()->paginate(10);
        return view('backend.personnel.user', compact('users'));
    }

    public function getView(Request $request)
    {
        $users = User::firstOrFail($request->id);
        return view('backend.personnel.view',compact('users'));
    }

    public function getAdd()
    {
        return view('backend.personnel.add_user');
    }


    public function postAdd(Request $request)
    {
            $rules = [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:6|max:32|confirmed',
                'phone' => 'required|max:32',
                'advisor' => 'required|max:255',
                'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'goal' => 'numeric',
            ];

        if ($request->has('email2')) {
            $rules['email2'] = 'email|max:255';
        }
        if ($request->has('phone2')) {
            $rules['phone2'] = 'max:32|numeric';
        }

            $validator = Validator::make($request->all(), $rules);

            $validator->setAttributeNames([
                'first_name' => 'Họ',
                'last_name' => 'Tên',
                'email' => 'E-Mail',
                'phone' => 'Số Điện thoại',
                'password' => 'Mật khẩu',
                'img' => 'Ảnh đại diện',
                'advisor' => 'Người phụ trách',
                'goal' => 'Chỉ tiêu',
            ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user = new User;
            if ($request->has('goal') && access()->user()->hasRole('Kỹ thuật')){
                $user->goal = $request->goal;
            }elseif(empty($request->goal) && access()->user()->hasRole('Kỹ thuật')){
                $user->goal = 0;
            }elseif(access()->user()->hasRole('Giám đốc') || access()->user()->hasRole('Trưởng phòng')){
                $user->goal = 0;
            }

            if ($request->hasFile('img')) {
                $file_name = auth()->id() . '_' . date('d-m-Y-H-i-s') . '.' . $request->file('img')->getClientOriginalExtension();
                $user->avatar = $file_name;
            }

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->email2 = $request->email2;
            $user->password = bcrypt($request->password);
            $user->confirmation_code = bcrypt($request->password_confirmation);
            $user->phone = $request->phone;
            $user->phone2 = $request->phone2;
            $user->advisor = $request->advisor;
            $user->status = $request->status;
            $user->confirmed = $request->confirmed;
            $user->save();
            if ($request->hasFile('img')) {
                $request->img->storeAs('public', $file_name);
            }
            return redirect('admin/personnel/users')->withFlashSuccess('Thêm nhân viên thành công.');
        }
    }


    public function getEdit(Request $request)
    {
        //check user id hay user phải là vai trò Nhân viên nếu ko sẽ edit cả người khác như admin hay giám đốc
        if (access()->user()->hasRole('Kỹ thuật')) {
            $users = User::find($request->id);
            return view('backend.personnel.edit_user', compact('users'));

        }elseif (access()->user()->hasRole('Nhân viên') && access()->id() == $request->id) {
            $users = User::find($request->id);
            return view('backend.personnel.edit_user', compact('users'));

        }else{
            return back()->withFlashDanger('Bạn không đủ quyền để sửa.');
        }
    }


    public function postEdit(Request $request)
    {
            $rules = [
                'first_name' => 'max:255',
                'last_name' => 'max:255',
                'email' => 'email|max:255|unique:users,email,' .$request->id,
                'phone' => 'max:32',
                'advisor' => 'max:255',
            ];

        if ($request->has('email2')) {
            $rules['email2'] = 'email|max:255';
        }

        if ($request->has('phone2')) {
            $rules['phone2'] = 'max:32|numeric';
        }

            $validator = Validator::make($request->all(), $rules);

            $validator->setAttributeNames([
                'first_name' => 'Họ',
                'last_name' => 'Tên',
                'email' => 'E-Mail',
                'phone' => 'Số Điện thoại',
                'password' => 'Mật khẩu',
                'img' => 'Ảnh đại diện',
                'advisor' => 'Người phụ trách',
                'goal' => 'Chỉ tiêu',
            ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if (access()->user()->hasRole('Kỹ thuật') || access()->user()->hasRole('Nhân viên') && access()->id() == $request->id) {
                $user = User::find($request->id);

                if ($request->has('goal') && access()->user()->hasRole('Kỹ thuật')){
                    $user->goal = $request->goal;
                    $user->status = $request->status;

                }elseif(empty($request->goal) && access()->user()->hasRole('Kỹ thuật')){
                    $user->goal = 0;
                    $user->status = $request->status;

                }elseif(access()->user()->hasRole('Nhân viên')){
                    $goal = DB::table('users')->where('id',$request->id)->select('goal','status')->first();
                    $user->goal = $goal->goal;
                    $user->status = $goal->status;
                }

                if ($request->hasFile('img')) {
                    $file_name = auth()->id() . '_' . date('d-m-Y-H-i-s') . '.' . $request->file('img')->getClientOriginalExtension();
                    $user->avatar = $file_name;
                }
                $user->email = $request->email;
                $user->email2 = $request->email2;
                if($request->password && $request->password_confirmation){
                    $user->password = bcrypt($request->password);
                    $user->confirmation_code = bcrypt($request->password_confirmation);
                }
                $user->phone = $request->phone;
                $user->phone2 = $request->phone2;
                $user->advisor = $request->advisor;
                $user->save();
                if ($request->hasFile('img')) {
                    $request->img->storeAs('public', $file_name);
                }
                return redirect('admin/personnel/users')->withFlashSuccess('Sửa thành công.');
                //check user id hay user phải là vai trò Nhân viên nếu ko sẽ edit cả người khác như admin hay giám đốc
            }
        }
    }

    public function getDelete(Request $request)
    {
        User::destroy($request->id);
        return redirect('admin/personnel/users');
    }

    public function getExcel()
    {
        $data_total = DB::table('role_user')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->join('users', 'role_user.user_id', '=', 'users.id')
            ->where('role_id', '3')
            ->get()->toArray();

        foreach ($data_total as $list){
            $exportxls['First_name'][] = $list->first_name;
            $exportxls['Last_name'][] = $list->last_name;
            $exportxls['Email'][] = $list->email;
            $exportxls['Mã nhân viên'][] = Utilities::getPID($list->id);
            $exportxls['Phone'][] = $list->phone;
            $exportxls['Người phụ trách'][] = $list->advisor;
        }

        return OfficeHelper::exportExcel($exportxls, 'DSNV.xls');
    }

}