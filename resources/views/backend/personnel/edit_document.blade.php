@extends ('backend.layouts.app')

@section ('title', 'Edit_Document')

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src={{asset('ckeditor/ckeditor.js')}}></script>
@endsection

@section('page-header')
    <h1>
        Quản lý biểu mẫu
    </h1>
@endsection

@section('content')
<form method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Tạo biểu mẫu</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div role="tabpanel">
{{--                        @include('backend.personnel.includes.tab')--}}
                        <div class="tab-content" style="margin-top: 20px">
                            <div class="form-group" >
                                <label>Tên biểu mẫu</label>
                                <input required type="text" name="document" class="form-control" value="{{$document_edit->document_name}}">
                            </div>

                            <div class="form-group" >
                                <label class="">Nội dung</label>
                                <textarea class="ckeditor" required name="description" id="description">{{$document_edit->document_content}}</textarea>
                            </div>

                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('description',{
                                        language:'vi',
                                        filebrowserImageBrowseUrl: '../../../ckfinder/ckfinder.html?Type=Images',
                                        filebrowserFlashBrowseUrl: '../../../ckfinder/ckfinder.html?Type=Flash',
                                        filebrowserImageUploadUrl: '../../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                        filebrowserFlashUploadUrl: '../../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                    });
                                </script>

                            <div class="pull-left">
                                <a class="btn btn-danger btn-xs" href="#">Hủy</a>
                            </div>
                            <div class="pull-right">
                                <input type="submit" value="Sửa" class="btn btn-success btn-xs">
                            </div>

                        </div>
                    </div><!--tab panel-->

                </div><!--panel body-->

            </div><!-- panel -->
        </div>
    </div>
</form>
@endsection

@section('after-scripts')
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}
@endsection
