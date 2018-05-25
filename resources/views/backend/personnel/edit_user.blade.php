@extends ('backend.layouts.app')

@section ('title', 'Nhân viên')

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
    <h1>
        {!! trans('labels.backend.personnel.personnel_management') !!}
        <small>Chỉnh sửa nhân viên <label class="control-label">{!! $users->last_name !!}</label></small>
    </h1>
@endsection

@section('content')
    <form method="post" class="form-horizontal" enctype="multipart/form-data">
        {{csrf_field()}}

    <div class="box box-success">

        <div class="box-header with-border">
            <h3 class="box-title">Chỉnh sửa nhân viên <label class="control-label">{!! $users->last_name !!}</label></h3>
            <div class="box-tools pull-right">
                <a href="{{url('admin/personnel/users')}}" class="btn btn-primary btn-xs">Tất cả nhân viên</a>
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="container">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Họ</label>
                        <div class="col-lg-9" >
                            <input type="text" name="first_name" class="form-control" required="required" placeholder="Họ" disabled value="{!! old('first_name' , $users->first_name) !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Tên</label>
                        <div class="col-lg-9" >
                            <input type="text" name="last_name" class="form-control" required="required" placeholder="Tên" disabled value="{!! old('last_name' , $users->last_name) !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Mã nhân viên</label>
                        <div class="col-lg-9" >
                            <input type="text" name="pid" class="form-control" required="required" placeholder="Mã nv" disabled value="{!! App\Helpers\Backend\Utilities::getPID($users->id) !!}">
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="col-lg-3 control-label"><label>Ảnh đại diện *</label></div>
                        <div class="col-lg-9"><img id="avatar" class="thumbnail" width="150px" src="{{asset('/storage/'.$users->avatar)}}"></div>
                        <input id="img" type="file" name="img" class="form-control hidden" onchange="changeImg(this)">
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">SĐT 1 *</label>
                        <div class="col-lg-9" >
                            <input type="number" name="phone" class="form-control" placeholder="SĐT 1" value="{!! old('phone' , $users->phone) !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">SĐT 2</label>
                        <div class="col-lg-9" >
                            <input type="number" name="phone2" class="form-control" placeholder="SĐT 2" value="{!! old('phone2' , $users->phone2) !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email 1 *</label>
                        <div class="col-lg-9" >
                            <input type="email" name="email" class="form-control" placeholder="Email 1" value="{!! old('email' , $users->email) !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email 2</label>
                        <div class="col-lg-9" >
                            <input type="email" name="email2" class="form-control" placeholder="Email 2" value="{!! old('email2' , $users->email2) !!}">
                        </div>
                    </div>
                </div> <!-- col-lg-6 -->

                <div class="col-lg-6">
                    @if(access()->user()->hasRole('Kỹ thuật'))
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Người phụ trách</label>
                        <div class="col-lg-9" >
                            <input type="text" name="advisor" class="form-control"  placeholder="Người phụ trách" value="{!! old('advisor' , $users->advisor) !!}">
                        </div>
                    </div>
                        @else
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Người phụ trách</label>
                            <div class="col-lg-9" >
                                <input type="text" name="advisor" class="form-control"  placeholder="Người phụ trách" disabled value="{!! old('advisor' , $users->advisor) !!}">
                            </div>
                        </div>
                    @endif

                    @if(access()->user()->hasRole('Kỹ thuật'))
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Chỉ tiêu năm</label>
                        <div class="col-lg-9" >
                            <input type="number" name="goal" step="0.00" class="form-control" placeholder="Chỉ tiêu năm" value="{!! old('goal' ,$users->goal) !!}">
                        </div>
                    </div>
                        @else
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Goal</label>
                                <div class="col-lg-9" >
                                    <input type="number" name="goal"   class="form-control" placeholder="Chỉ tiêu năm" disabled value="{!! old('goal' , $users->goal) !!}">
                                </div>
                            </div>
                    @endif

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Mật khẩu *</label>
                        <div class="col-lg-9" >
                            <input type="password" name="password"  class="form-control" placeholder="Mật khẩu">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Xác nhận mật khẩu *</label>
                        <div class="col-lg-9" >
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Trạng thái</label>

                        @if(access()->user()->hasRole('Kỹ thuật'))
                        <div class="col-lg-9" style="padding-top: 7px">
                            <input type="radio" value="1" name="status" @if($users->status == 1) checked @endif/> <strong style="margin-right: 5px;"> Hoạt động</strong>

                            <input type="radio" value="0" name="status" @if($users->status == 0) checked @endif> <strong> Không hoạt động</strong>
                        </div>
                            @else
                            <div class="col-lg-9" style="padding-top: 7px">
                                @if($users->status == 1)
                                    <label class="btn btn-success btn-xs">Hoạt động</label>
                                    @else
                                    <label class="btn btn-success btn-xs">Không hoạt động</label>
                                 @endif
                            </div>
                        @endif
                    </div>
                </div> <!-- col-lg-6 -->

            </div> <!-- container -->
        </div><!-- box-body -->
    </div> <!-- box-success -->

        <div class="box box-info">
            <div class="box-body">
                <div class="pull-left btn btn-danger btn-xs"><a href="{!! url('admin/personnel/users') !!}" style="color: #ffffff">Hủy</a></div>
                <div class="pull-right"><input class="btn btn-success" type="submit" value="Sửa"></div>
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
