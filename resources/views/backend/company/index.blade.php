@extends ('backend.layouts.app')

@section ('title', 'Quản lí công ty')

@section('page-header')
    <h1>
        Quản lí công ty
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Danh sách</h3>
            <div class="box-tools pull-right">
                @include('backend.company.includes.partials.company-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên công ty</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th>Người liên hệ</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($company_list as $company)
                            @php
                                $id = App\Helpers\Backend\Utilities::getCompanyId($company->id);
                            @endphp
                            <tr>
                                <td>{!! $id !!}</td>
                                <td>{!! $company->company_name !!}</td>
                                <td>{!! $company->address !!}</td>
                                <td>{!! $company->email_address !!}</td>
                                <td>{!! $company->person_charge !!}</td>
                                <td>@if($company->active == 1)
                                        Hoạt động
                                    @else
                                        Không hoạt động
                                    @endif
                                </td>
                                <td>
                                    <a href="{!! route('admin.company.show' , ['id' => $company->id]) !!}" class="btn btn-info btn-xs"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xem"></i></a>
                                    <a href="{!! route('admin.company.edit' , ['id' => $id]) !!}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sửa"></i></a>
                                    <a href="{!! route('admin.company.submit.delete' , ['id' => $company->id]) !!}" class="btn btn-danger btn-xs"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa"></i></a>
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
