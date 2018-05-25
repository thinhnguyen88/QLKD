@extends ('backend.layouts.app')

@section ('title', 'Quản lí lịch hẹn | Thêm mới lịch hẹn')

@section('page-header')
    <h1>
        Quản lí lịch hẹn
        <small>Thêm mới lịch hẹn</small>
    </h1>
@endsection
@section('after-styles')
    {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css') }}

@endsection

@section('content')
    <form class="form-horizontal" method="post" action="{!! route('admin.appointment.submit.add') !!}">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm mới lịch hẹn</h3>
                <div class="box-tools pull-right">
                    <a class="btn btn-primary btn-xs" href="{!! route('admin.appointment.index') !!}">Tất cả cuộc hẹn</a>
                    <a class="btn btn-success btn-xs" href="{!! route('admin.appointment.add') !!}">Tạo cuộc hẹn</a>
                    <a class="btn btn-warning btn-xs" href="{!! route('admin.appointment.all.cancel') !!}">Các cuộc hẹn đã hủy</a>
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="container">

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Đối tác</label>
                            <div class="col-lg-9" >
                                <select name="company" id="" class="form-control">
                                    <option value="0">Chọn công ty</option>
                                    @foreach($list_company as $item)
                                        <option value="{!! $item->id !!}">{!! $item->company_name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Tiêu đề cuộc hẹn</label>
                            <div class="col-lg-9" >
                                <input type="text" name="title" required="required" class="form-control" placeholder="Tiêu đề cuộc hẹn" value="{!! old('place') !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Địa điểm</label>
                            <div class="col-lg-9" >
                                <input type="text" name="place" required="required" class="form-control" placeholder="Địa điểm hẹn" value="{!! old('place') !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Bắt đầu</label>
                            <div class="col-lg-9" >
                                <input type="text" id="start_time" name="start_time" required="required" class="form-control" placeholder="Thời gian bắt đầu " value="{!! old('start_time') !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Kết thúc</label>
                            <div class="col-lg-9" >
                                <input type="text" id="finish_time" name="finish_time" required="required" class="form-control" placeholder="Thời gian kết thúc" value="{!! old('finish_time') !!}">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="box box-info">
            <div class="box-body">
                <div class="pull-left btn btn-danger btn-xs"><a href="{!! route('admin.appointment.index') !!}" style="color: #ffffff">Hủy</a></div>
                <div class="pull-right"><input class="btn btn-success" type="submit" value="Thêm"></div>
            </div>
        </div>
    </form>

@endsection

@section('after-scripts')
    {{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js') }}

    <script>
        $(document).ready(function () {
            $.datetimepicker.setLocale('vi');

            $('#start_time').datetimepicker({
                format:'d-m-Y H:i',
            });
            $('#finish_time').datetimepicker({
                format:'d-m-Y H:i',
            });
        });
    </script>
@endsection

