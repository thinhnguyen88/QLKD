@extends ('backend.layouts.app')

@section ('title', 'Document')

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
                            <a href="{{url('admin/personnel/documents/add')}}" class="btn btn-success btn-xs">Tạo biểu mẫu</a>
                        @endif
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane mt-30 active" id="personnel-list">
                                <div class="table-responsive">
                                    <table id="users-table" class="table table-condensed table-hover table-bordered textCenter">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên Biểu mẫu</th>
                                                <th>Hành động</th>
                                            </tr>

                                        @foreach($document as $list)
                                            <tr>
                                                <td>{{$list->id}}</td>
                                                <td>{{$list->document_name}}</td>
                                                <td>
                                                    <a class="btn btn-info btn-xs " href="{{url('admin/personnel/documents/'.$list->document_slug)}}"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xem"></i></a>
                                                    @if(access()->user()->hasRole('Kỹ thuật') || access()->user()->hasRole('Giám đốc') || access()->user()->hasRole('Trưởng phòng'))
                                                        <a href="{{url('admin/personnel/documents/edit/'.$list->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sửa"></i></a>
                                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa')" href="{{url('admin/personnel/documents/delete/ '.$list->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </thead>
                                    </table>
                                    {{--{{$users->links()}}--}}
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
