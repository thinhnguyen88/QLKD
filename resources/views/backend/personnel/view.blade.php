@extends ('backend.layouts.app')
@section ('title', 'Thông tin nhân viên')

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
    <h1>
        {!! trans('labels.backend.personnel.personnel_management') !!}
        <small>Quản lý nhân viên</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Thông tin chi tiết</h3>
            <div class="box-tools pull-right">
                <a href="{{url('admin/personnel/users')}}" class="btn btn-primary btn-xs">Tất cả nhân viên</a>
                    @if(access()->user()->hasRole('Kỹ thuật') || access()->user()->hasRole('Giám đốc') || access()->user()->hasRole('Trưởng phòng'))
                        <a href="{{url('admin/personnel/users/add')}}" class="btn btn-success btn-xs">Thêm nhân viên</a>
                    @endif
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-lg-6">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Họ</th>
                            <td>{!! $users->first_name !!}</td>
                        </tr>
                        <tr>
                            <th>Tên</th>
                            <td>{!! $users->last_name !!}</td>
                        </tr>
                        <tr>
                            <th>Mã nhân viên</th>
                            <td>{!! App\Helpers\Backend\Utilities::getPID($users->id) !!}</td>
                        </tr>
                        <tr>
                            <th>Ảnh đại diện</th>
                            <td>{!! url('storage/'.$users->avatar) !!}</td>
                        </tr>

                        <tr>
                            <th>SĐT 1</th>
                            <td>{!! $users->phone !!}</td>
                        </tr>
                        <tr>
                            <th>SĐT2</th>
                            <td>{!! $users->phone2 !!}</td>
                        </tr>
                        <tr>
                            <th>Email 1 </th>
                            <td>{!! $users->email !!}</td>
                        </tr>
                        <tr>
                            <th>Email 2</th>
                            <td>{!! $users->email2 !!}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Người phụ trách</th>
                            <td>{!! $users->advisor !!}</td>
                        </tr>

                        <tr>
                            <th>Chỉ tiêu năm</th>
                            <td>{!! number_format($users->goal , 2 , ',' , '.') !!}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            @if($users->status == 1)
                                <td><label class="btn btn-success btn-xs">Hoạt động</label></td>
                            @else
                                <td><label class="btn btn-success btn-xs">Ngừng hoạt động</label></td>
                            @endif
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}
@endsection
