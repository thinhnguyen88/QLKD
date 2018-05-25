@extends ('backend.layouts.app')

@section ('title', 'Quản lí công ty | Thông tin chi tiết')

@section('page-header')
    <h1>
        Quản lí công ty
        <small> Công ty <label> {!! $company->company_name !!}</label></small>
    </h1>
@endsection

@section('content')

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Thông tin chi tiết</h3>
            <div class="box-tools pull-right">
                @include('backend.company.includes.partials.company-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-lg-6">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Tên công ty</th>
                            <td>{!! $company->company_name !!}</td>
                        </tr>
                        <tr>
                            <th>Địa chỉ</th>
                            <td>{!! $company->address !!}</td>
                        </tr>
                        <tr>
                            <th>Mã số thuế</th>
                            <td>{!! $company->tax_identification_number !!}</td>
                        </tr>
                        <tr>
                            <th>Số tài khoản</th>
                            <td>{!! $company->account_number !!}</td>
                        </tr>
                        <tr>
                            <th>Ngân hàng</th>
                            <td>{!! $company->bank_branch !!}</td>
                        </tr>
                        <tr>
                            <th>SĐT </th>
                            <td>{!! $company->phone_number !!}</td>
                        </tr>
                        <tr>
                            <th>Email  </th>
                            <td>{!! $company->email_address !!}</td>
                        </tr>
                        <tr>
                            <th>Website</th>
                            <td>{!! $company->website !!}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Người liên hệ</th>
                            <td>{!! $company->person_charge !!}</td>
                        </tr>

                        <tr>
                            <th>SĐT người liên hệ</th>
                            <td>{!! $company->person_charge_phone_number !!}</td>
                        </tr>
                        <tr>
                            <th>Email người liên hệ</th>
                            <td>{!! $company->person_charge_email_address !!}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            @if($company->active == 1)
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


@section('after-styles')

@endsection

@section('after-scripts')
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}
@endsection
