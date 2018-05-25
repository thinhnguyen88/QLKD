@extends ('backend.layouts.app')

@section ('title', 'Quản lí lịch hẹn')

@section('page-header')
    <h1>
        Quản lí lịch hẹn
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Danh sách</h3>
            <div class="box-tools pull-right">
                <div class="pull-right mb-10 hidden-sm hidden-xs">
                    <a class="btn btn-primary btn-xs" href="{!! route('admin.appointment.index') !!}">Tất cả cuộc hẹn</a>
                    <a class="btn btn-success btn-xs" href="{!! route('admin.appointment.add') !!}">Tạo cuộc hẹn</a>
                    <a class="btn btn-warning btn-xs" href="{!! route('admin.appointment.all.cancel') !!}">Các cuộc hẹn đã hủy</a>
                </div><!--pull right-->
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Mã NV</th>
                        <th>Tên NV</th>
                        <th>Tiêu đề</th>
                        <th>Đối tác</th>
                        <th>Địa điểm</th>
                        <th>Bắt đầu </th>
                        <th>Kết thúc</th>
                        <th>Trạng thái</th>
                        @if(access()->user()->hasRole('Trưởng phòng'))
                            <th>Phê duyệt</th>
                        @elseif(access()->user()->hasRole('Nhân viên'))
                            <th>Hành động</th>
                        @endif
                        <th>Người phê duyệt</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list_appointment as $appointment)
                        @php
                            $id = App\Helpers\Backend\Utilities::getPID($appointment->user->id);
                        @endphp
                        <tr>
                            <td>{!! $id !!}</td>
                            <td>{!! $appointment->user->first_name . " " . $appointment->user->last_name !!} </td>
                            <td>{!! substr($appointment->title,0,25) !!}</td>
                            <td>{!! $appointment->company->company_name !!}</td>
                            <td>{!! $appointment->place !!}</td>
                            <td>{!! $appointment->start_time !!}</td>
                            <td>{!! $appointment->finish_time !!}</td>
                            <td>@if($appointment->active == 0)
                                    <span class="btn btn-warning btn-xs">Chưa phê duyệt</span>
                                @elseif($appointment->active == 1)
                                    <span class="btn btn-primary btn-xs">Đã phê duyệt</span>
                                @else
                                    <span class="btn btn-danger btn-xs">Đã hủy</span>
                                @endif
                            </td>

                            <td>
                                @if($appointment->active == 2)
                                    <a onclick="confirm('Bạn có chắc khôi phục và đồng ý lịch hẹn này k?')" href="{!! route('admin.appointment.agree' , ['id' => $appointment->id]) !!}" class="btn btn-primary btn-xs">Khôi phục và đồng ý</a>
                                @else
                                    @if(access()->user()->hasRole('Trưởng phòng'))
                                        @if($appointment->active == 0)
                                            <a href="{!! route('admin.appointment.agree' , ['id' => $appointment->id]) !!}" onclick="confirm('Bạn có chắc đồng ý lịch hẹn này k?')" class="btn btn-success btn-xs">Đồng ý</a>

                                            <a href="{!! route('admin.appointment.cancel' , ['id' => $appointment->id]) !!}" onclick="confirm('Bạn có chắc hủy lịch hẹn này k?')" class="btn btn-danger btn-xs">Hủy</a>
                                        @endif
                                    @elseif(access()->user()->hasRole('Nhân viên'))
                                        @if($appointment->user_id == access()->user()->id)
                                            <a href="{!! route('admin.appointment.edit' , ['id' => $appointment->id]) !!}" class="btn btn-primary btn-xs">Sửa</a>
                                            <a href="{!! route('admin.appointment.delete' , ['id' => $appointment->id]) !!}" class="btn btn-danger btn-xs">Xóa</a>
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if(!empty($appointment->approver_uid))
                                    {!! $appointment->approver->first_name . " " . $appointment->approver->last_name !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div>
    </div>


@endsection

