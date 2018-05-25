@extends ('backend.layouts.app')

@section ('title', 'Permission')

@section('after-styles')
{{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
<h1>
    Quản lý quyền
</h1>
@endsection

@section('content')
<form method="post" class="form-horizontal">
    {{csrf_field()}}
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Tạo quyền</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="form-group">
                {{ Form::label('Tên', 'Tên', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('permission', null, ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Tên']) }}
                </div>
            </div>
        </div>
    </div>

    <div class="box box-success">
        <div class="box-body">
            <div class="pull-left">
                <a href="{{url('admin/access/permission')}}" class="btn btn-danger btn-xs">Hủy</a>
            </div>
            <div class="pull-right">
                <input type="submit" value="Tạo" class="btn btn-success btn-xs">
            </div>
        </div>
    </div>
</form>
@endsection

@section('after-scripts')
{{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
{{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}
@endsection
