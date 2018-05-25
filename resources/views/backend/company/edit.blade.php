@extends ('backend.layouts.app')

@section ('title', 'Quản lí công ty | Chỉnh sửa Công ty')

@section('page-header')
    <h1>
        Quản lí công ty
        <small>Chỉnh sửa công ty <label class="control-label">{!! $company->company_name !!}</label></small>
    </h1>
@endsection

@section('content')
    <form class="form-horizontal" method="post" action="{!! route('admin.company.submit.edit' , ['id' => $company->id]) !!}">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Chỉnh sửa công ty <label class="control-label">{!! $company->company_name !!}</label></h3>
                <div class="box-tools pull-right">
                    @include('backend.company.includes.partials.company-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="container">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Tên công ty *</label>
                            <div class="col-lg-9" >
                                <input type="text" name="company_name" required="required" class="form-control" placeholder="Company Name" value="{!! old('company_name' , $company->company_name ) !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Địa chỉ *</label>
                            <div class="col-lg-9" >
                                <input type="text" name="address" required="required" class="form-control" placeholder="Address" value="{!! old('address' , $company->address ) !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Mã số thuế *</label>
                            <div class="col-lg-9" >
                                <input type="text" name="tax_identification_number" required="required" class="form-control" placeholder="Tax Identification Number" value="{!! old('tax_identification_number' , $company->tax_identification_number) !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Số tài khoản</label>
                            <div class="col-lg-9" >
                                <input type="text" name="account_number" class="form-control" placeholder="Account Number" value="{!! old('account_number' , $company->account_number) !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Ngân hàng</label>
                            <div class="col-lg-9" >
                                <input type="text" name="bank_branch" class="form-control" placeholder="Bank_Branch" value="{!! old('bank_branch' , $company->bank_branch) !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Số điện thoại </label>
                            <div class="col-lg-9" >
                                <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" value="{!! old('phone_number' , $company->phone_number) !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Địa chỉ Email </label>
                            <div class="col-lg-9" >
                                <input type="text" name="email_address" class="form-control" placeholder="Email Address" value="{!! old('email_address' , $company->email_address) !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Website</label>
                            <div class="col-lg-9" >
                                <input type="text" name="website_address" class="form-control" placeholder="Website Address" value="{!! old('website_address' , $company->website) !!}">
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Người liên hệ *</label>
                            <div class="col-lg-9" >
                                <input type="text" name="person_charge" class="form-control" required="required" placeholder="Person In Charge" value="{!! old('person_charge' , $company->person_charge) !!}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">SĐT người l.hệ *</label>
                            <div class="col-lg-9" >
                                <input type="text" name="person_charge_phone_number" required="required" class="form-control" placeholder="Phone Number" value="{!! old('person_charge_phone_number' , $company->person_charge_phone_number) !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email người l.hệ *</label>
                            <div class="col-lg-9" >
                                <input type="email" name="person_charge_email_address" required="required" class="form-control" placeholder="Email Address" value="{!! old('person_charge_email_address' , $company->person_charge_email_address) !!}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Trạng thái</label>
                            <div class="col-lg-9" style="text-align: center">

                                <input type="radio" value="1" name="active" @if($company->active == 1) checked @endif/> <strong style="margin-right: 5px;"> Hoạt động</strong>

                                <input type="radio" value="0" name="active" @if($company->active == 0) checked @endif> <strong> Không hoạt động</strong>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-info">
            <div class="box-body">
                <div class="pull-left btn btn-danger btn-xs"><a href="{!! route('admin.company.index') !!}" style="color: #ffffff">Hủy</a></div>
                <div class="pull-right"><input class="btn btn-success" type="submit" value="Sửa"></div>
            </div>
        </div>
    </form>

@endsection


@section('after-styles')

@endsection

@section('after-scripts')
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}

@endsection
