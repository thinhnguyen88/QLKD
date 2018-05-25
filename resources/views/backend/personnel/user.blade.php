@extends ('backend.layouts.app')

@section ('title', 'Nhân viên')

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
    <h1>
        {!! trans('labels.backend.personnel.personnel_management') !!}
        <small>{!! trans('labels.backend.personnel.personnel_activities') !!}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{!! trans('labels.backend.personnel.personnel_activities') !!}</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
                    <div role="tabpanel">
{{--                        @include('backend.personnel.includes.tab')--}}
                            @if(access()->user()->hasRole('Kỹ thuật') || access()->user()->hasRole('Giám đốc') || access()->user()->hasRole('Trưởng phòng'))
                                    <a href="{{url('admin/personnel/users/add')}}" class="btn btn-success btn-xs">Thêm nhân viên</a>
                                    <a onclick="return confirm('In danh sách nhân viên')" href="{{ route('admin.personnel.users.getExcel') }}" class="btn btn-info btn-xs">In danh sách nhân viên</a>
                            @endif

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane mt-30 active" id="personnel-list">
                                <div class="table-responsive">
                                    <table id="users-table" class="table table-condensed table-hover table-bordered textCenter">
                                        <thead>
                                        <tr>
                                            <th>Mã nv</th>
                                            <th>Tên</th>
                                            <th>Ảnh</th>
                                            <th>SĐT</th>
                                            <th>Email</th>
                                            <th>Người phụ trách</th>
                                            <th>Hành động</th>
                                        </tr>
                                        @foreach($users as $list)
                                        <tr>
                                            <td>{{App\Helpers\Backend\Utilities::getPID($list->id)}}</td>
                                            <td>{{$list->last_name}}</td>
                                            <td><img height="30px" src="{{asset('storage/'.$list->avatar)}}"></td>
                                            <td>{{$list->phone}}</td>
                                            <td>{{$list->email}}</td>
                                            <td>{{$list->advisor}}</td>
                                            <td>
                                                @if(access()->user()->hasRole('Kỹ thuật') || access()->user()->hasRole('Nhân viên') && $list->id == access()->id())
                                                    <a href="{{url('admin/personnel/users/view/'.$list->id)}}" class="btn btn-info btn-xs"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xem"></i></a>
                                                @endif
                                                @if(access()->user()->hasRole('Nhân viên') && $list->id == access()->id())
                                                    <a href="{{url('admin/personnel/users/edit/'.$list->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sửa"></i></a>
                                                @elseif(access()->user()->hasRole('Kỹ thuật'))
                                                    <a href="{{url('admin/personnel/users/edit/'.$list->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sửa"></i></a>
                                                @endif

                                                @if(access()->user()->hasRole('Kỹ thuật'))
                                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa')" href="{{url('admin/personnel/users/delete/ '.$list->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        </thead>
                                    </table>
                                    {{$users->links()}}
                                </div>
                            </div><!--tab panel profile-->
                        </div><!--tab content-->

                    </div><!--tab panel-->
        </div>
    </div>

@endsection

@section('after-scripts')
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}
@endsection
