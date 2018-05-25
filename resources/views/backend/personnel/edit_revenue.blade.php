@extends ('backend.layouts.app')

@section ('title', 'Thay đổi doanh thu')

@section('page-header')
    <h1>
        Hoạt động kinh doanh
    </h1>
    <style>
        .m-money{
            position: relative;
        }
        .m-money:hover .m-tooltip{
            display: block;
        }
        .m-tooltip{
            display: none;
        }
        .m-money .m-tooltip{
            position: absolute;
            height: 28px;
            width: auto;
            background-color: #fff;
            border: 1px solid #E7E7E7;
            padding-top: 4px;
            padding-left: 10px;
            padding-right: 10px;
            border-bottom: 0px;
            font-family: "Roboto";
            font-size: 10pt;
            z-index: 9999;
            background-color: black;
            color: #fff;
            border-radius: 6px;
            top: -35px;
        }
    </style>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.personnel.revenues.postEdit', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Thay đổi doanh thu</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="form-group">
                {{ Form::label('company', 'Công ty', ['class' => 'col-lg-2 control-label']) }}
                <input type="hidden" name="id" value="{{ $revenue->id }}">
                <div class="col-lg-10">
                    {{ Form::text('company', $company->company_name, ['class' => 'form-control', 'maxlength' => '255', 'disabled' => 'disabled', 'autofocus' => 'autofocus', 'placeholder' => 'Tên công ty']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('advisor', 'Người phụ trách',
                 ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('advisor', $company->person_charge, ['class' => 'form-control', 'maxlength' => '255', 'disabled' => 'disabled', 'placeholder' => 'Người phụ trách']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('email', 'E-Mail',
                 ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::email('email', $company->email_address, ['class' => 'form-control', 'maxlength' => '255', 'disabled' => 'disabled', 'placeholder' => 'E-Mail']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('phone', 'Điện thoại',
                 ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('phone', $company->phone_number, ['class' => 'form-control', 'maxlength' => '32', 'disabled' => 'disabled', 'placeholder' => 'Điện thoại']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('datetime', 'Ngày tháng',
                 ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('datetime', date('d-m-Y H:i', strtotime($revenue->datetime)), ['class' => 'form-control', 'maxlength' => '32', 'disabled' => 'disabled', 'placeholder' => 'Ngày phát sinh doanh thu']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('service', 'Loại dịch vụ',
                 ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('service', $service->name, ['class' => 'form-control', 'maxlength' => '32', 'disabled' => 'disabled', 'placeholder' => 'Loại hình dịch vụ']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('profit', 'Lợi nhuận',
                 ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10 m-money">
                    <div class="m-tooltip"></div>
                    {{ Form::number('profit', (old('profit') ? old('profit') : $revenue->profit), ['class' => 'form-control', 'maxlength' => '32',  'placeholder' => 'Lợi nhuận' , 'step'=>'any']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group ">

                {{ Form::label('revenue', 'Doanh thu',
                 ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10 m-money">
                    <div class="m-tooltip"></div>
                    {{ Form::number('revenue', (old('revenue') ? old('revenue') : $revenue->revenue), ['class' => 'form-control', 'maxlength' => '32', 'required' => 'required', 'placeholder' => 'Doanh thu' , 'step'=>'any']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('reason_for_update', 'Lý do thay đổi',
                 ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::textarea('reason_for_update', (old('reason_for_update') ? old('reason_for_update') : $revenue->reason_for_update), ['class' => 'form-control', 'maxlength' => '500', 'required' => 'required', 'placeholder' => 'Lý do thay đổi Doanh thu']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-info">
        <div class="box-body">
            <div class="pull-left">
                {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-success btn-xs']) }}
            </div><!--pull-right-->

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->

    {{ Form::close() }}
@endsection

@section('after-scripts')
    <script>

        $(document).on('mouseenter','.m-money' , function () {
            var value = $(this).find('input').val();
            if (!value){
                $(this).find('.m-tooltip').text('Chưa nhập giá trị');
            }else{
                value = (value + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
                $(this).find('.m-tooltip').text(value);
            }
        });

        $(document).on('keyup' , '.m-money input' , function () {
            var value2 = $(this).val();
            if (!value2){
                $(this).prev().text('Chưa nhập giá trị');
            }else{
                value2 = (value2 + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
                $(this).prev().text(value2);
            }
        });

    </script>
@endsection
