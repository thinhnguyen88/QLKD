@extends ('backend.layouts.app')

@section ('title', 'Thêm chỉ tiêu')

@section('page-header')
    <h1>
        Hoạt động kinh doanh
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.personnel.business.postAddGoals', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Thêm chỉ tiêu</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="form-group">
                {{ Form::label('goals', 'Chỉ tiêu cả năm', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('goals', old('goals') ? old('goals') : (isset($goals->goals) ? $goals->goals: ''), ['class' => 'form-control', 'maxlength' => '255', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Chỉ tiêu cả năm']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->
        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-info">
        <div class="box-body">
            <div class="pull-left">
                {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-xs']) }}
            </div><!--pull-right-->

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->

    {{ Form::close() }}
@endsection
