@extends ('backend.layouts.app')

@section ('title', 'Quản lí dịch vụ | Sửa dịch vụ')

@section('page-header')
    <h1>
        Quản lí dịch vụ
        <small>Sửa dịch vụ <strong>{!! $service->name !!}</strong></small>
    </h1>
@endsection

@section('content')
    <form class="form-horizontal" method="post" action="{!! route('admin.service.submit.edit' , ['id' => $service->id]) !!}">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Sửa dịch vụ</h3>
                <div class="box-tools pull-right">
                    @include('backend.service.includes.buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="container">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Tên dịch vụ</label>
                            <div class="col-lg-9" >
                                <input type="text" name="service_name" required="required" class="form-control" placeholder="Service name" value="{!! old('service_name' , $service->name) !!}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Trạng thái</label>
                            <div class="col-lg-9" style="text-align: center">
                                <input type="radio" value="1" name="active" @if($service->active == 1) checked @endif/> <strong style="margin-right: 5px;"> Hoạt động</strong>

                                <input type="radio" value="0" name="active" @if($service->active == 0) checked @endif> <strong> Không hoạt động</strong>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-info">
            <div class="box-body">
                <div class="pull-left btn btn-danger btn-xs"><a href="{!! route('admin.service.index') !!}" style="color: #ffffff">Hủy</a></div>
                <div class="pull-right"><input class="btn btn-success" type="submit" value="Sửa"></div>
            </div>
        </div>
    </form>

@endsection

