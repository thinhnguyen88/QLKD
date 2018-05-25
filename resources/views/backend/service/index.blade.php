@extends ('backend.layouts.app')

@section ('title', 'Quản lí dịch vụ')

@section('page-header')
    <h1>
        Quản lí dịch vụ
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Danh sách</h3>
            <div class="box-tools pull-right">
                @include('backend.service.includes.buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Loại dịch vụ</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($service_list as $item)
                        @php
                            $id = App\Helpers\Backend\Utilities::getCompanyId($item->id);
                        @endphp
                        <tr>
                            <td>{!! $id !!}</td>
                            <td>{!! $item->name !!}</td>
                            <td>@if($item->active == 1)
                                    Hoạt động
                                @else
                                    Không hoạt động
                                @endif
                            </td>
                            <td>
                                <a href="{!! route('admin.service.edit' , ['id' => $id]) !!}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sửa"></i></a>
                                <a href="{!! route('admin.service.submit.delete' , ['id' => $id]) !!}" class="btn btn-danger btn-xs"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div>
    </div>


@endsection


@section('after-styles')

@endsection

@section('after-scripts')

@endsection
