@extends ('backend.layouts.app')
@section ('title', 'Nhân viên')

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
    <h1>
        {!! trans('labels.backend.personnel.personnel_management') !!}
        <small>Thêm nhân viên</small>
    </h1>
@endsection

@section('content')
    <form method="post" class="form-horizontal" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="box box-success">

            <div class="box-header with-border">
                <h3 class="box-title">Thêm nhân viên</h3>
                <div class="box-tools pull-right">
                    <a href="{{url('admin/personnel/users')}}" class="btn btn-primary btn-xs">Tất cả nhân viên</a>
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="container">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Họ *</label>
                            <div class="col-lg-9" >
                                <input type="text" name="first_name" class="form-control" placeholder="Họ"">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Tên *</label>
                            <div class="col-lg-9" >
                                <input type="text" name="last_name" class="form-control" placeholder="Tên">
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="col-lg-3 control-label"><label>Ảnh đại diện *</label></div>
                            <div class="col-lg-9"><img id="avatar" class="thumbnail" width="150px" src="{{asset('/img/avatar.png')}}"></div>
                            <input required id="img" type="file" name="img" class="form-control hidden" onchange="changeImg(this)">
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">SĐT 1 *</label>
                            <div class="col-lg-9" >
                                <input type="number" name="phone" class="form-control" placeholder="SĐT 1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">SĐT 2</label>
                            <div class="col-lg-9" >
                                <input type="number" name="phone2" class="form-control" placeholder="SĐT 2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email 1 *</label>
                            <div class="col-lg-9" >
                                <input type="email" name="email" class="form-control" placeholder="Email 1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email 2</label>
                            <div class="col-lg-9" >
                                <input type="email" name="email2" class="form-control" placeholder="Email 2">
                            </div>
                        </div>
                    </div> <!-- col-lg-6 -->

                    <div class="col-lg-6">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Người phụ trách *</label>
                            <div class="col-lg-9" >
                                <input type="text" name="advisor" class="form-control" required="required" placeholder="Người phụ trách">
                            </div>
                        </div>

                    @if(access()->user()->hasRole('Kỹ thuật'))
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Chỉ tiêu năm</label>
                            <div class="col-lg-9" >
                                <input type="number" step="0.00" name="goal" class="form-control" placeholder="Chỉ tiêu năm">
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Mật khẩu *</label>
                            <div class="col-lg-9" >
                                <input type="password" name="password" required="required" class="form-control" placeholder="Mật khẩu">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Xác nhận mật khẩu *</label>
                            <div class="col-lg-9" >
                                <input type="password" name="password_confirmation" required="required" class="form-control" placeholder="Xác nhận mật khẩu">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Xác nhận</label>
                            <div class="col-lg-9" style="padding-top: 7px">
                                <input type="radio" value="1" name="confirmed" checked>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Trạng thái</label>

                            <div class="col-lg-9" style="padding-top: 7px">
                                <input type="radio" value="1" name="status" checked> <strong style="margin-right: 5px;"> Hoạt động</strong>
                                <input type="radio" value="0" name="status"> <strong> Không hoạt động</strong>
                            </div>
                        </div>
                    </div> <!-- col-lg-6 -->

                </div> <!-- container -->
            </div><!-- box-body -->
        </div> <!-- box-success -->

        <div class="box box-info">
            <div class="box-body">
                <div class="pull-left btn btn-danger btn-xs"><a href="{!! url('admin/personnel/users') !!}" style="color: #ffffff">Hủy</a></div>
                <div class="pull-right"><input class="btn btn-success" type="submit" value="Thêm"></div>
            </div>
        </div>
    </form>

@endsection

@section('after-scripts')
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}
    <script>
        $(document).ready(function() {
            $('#avatar').click(function(){
                $('#img').click();
            });
        });
        function changeImg(input){
            //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
            if(input.files && input.files[0]){
                var reader = new FileReader();
                //Sự kiện file đã được load vào website
                reader.onload = function(e){
                    //Thay đổi đường dẫn ảnh
                    $('#avatar').attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
