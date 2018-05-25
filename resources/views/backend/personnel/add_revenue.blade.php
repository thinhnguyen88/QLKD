@extends ('backend.layouts.app_ajax')

@section ('title', 'Thêm doanh thu')

@section('page-header')
    <h1>
        Hoạt động kinh doanh
    </h1>
    <style>
        #suggesstion-box{
            display: block;
        }
        #suggesstion-box ul li:hover{
            background-color: #cbd9da;
            color: #ffffff;
            cursor: pointer;
        }
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
    <div class="row">
        <div class="col-lg-12">
            {{ Form::open(['route' => 'admin.personnel.revenues.postAdd', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm doanh thu</h3>
                </div><!-- /.box-header -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="box-body">
                            <div class="form-group">
                                {{ Form::label('company', 'Công ty', ['class' => 'col-lg-3 control-label']) }}

                                <div class="col-lg-9">
                                    {{ Form::text('company', old('company'), ['class' => 'form-control', 'maxlength' => '255', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Tên công ty' , 'autocomplete' => 'off']) }}
                                    <input type="hidden" name="company_id" value="" id="company_id">
                                    <div id="suggesstion-box"></div>
                                </div><!--col-lg-10-->
                            </div><!--form control-->

                            <div class="form-group">
                                {{ Form::label('address', 'Địa chỉ',
                                 ['class' => 'col-lg-3 control-label']) }}

                                <div class="col-lg-9">
                                    {{ Form::text('address', old('address'), ['class' => 'form-control', 'maxlength' => '255', 'required' => 'required', 'placeholder' => 'Địa chỉ' ,'disabled']) }}
                                </div><!--col-lg-10-->
                            </div><!--form control-->

                            <div class="form-group">
                                {{ Form::label('tax_identification', 'Mã số thuế',
                                 ['class' => 'col-lg-3 control-label']) }}
                                <div class="col-lg-9">
                                    {{ Form::text('tax_identification', old('tax_identification'), ['class' => 'form-control', 'maxlength' => '255', 'required' => 'required', 'placeholder' => 'Mã số thuế' ,'disabled']) }}
                                </div><!--col-lg-10-->
                            </div><!--form control-->

                            <div class="form-group">
                                {{ Form::label('phone', 'Điện thoại',
                                 ['class' => 'col-lg-3 control-label']) }}

                                <div class="col-lg-9">
                                    {{ Form::text('phone', old('phone'), ['class' => 'form-control', 'maxlength' => '32', 'required' => 'required', 'placeholder' => 'Điện thoại' ,'disabled' ]) }}
                                </div><!--col-lg-10-->
                            </div><!--form control-->

                            <div class="form-group">
                                {{ Form::label('email', 'E-Mail',
                                 ['class' => 'col-lg-3 control-label']) }}

                                <div class="col-lg-9">
                                    {{ Form::email('email', old('email'), ['class' => 'form-control', 'maxlength' => '255', 'required' => 'required', 'placeholder' => 'E-Mail' ,'disabled' ]) }}
                                </div><!--col-lg-10-->
                            </div><!--form control-->

                            <div class="form-group">
                                {{ Form::label('advisor', 'Người phụ trách',
                                 ['class' => 'col-lg-3 control-label']) }}

                                <div class="col-lg-9">
                                    {{ Form::text('advisor', old('advisor'), ['class' => 'form-control', 'maxlength' => '255', 'required' => 'required', 'placeholder' => 'Người phụ trách' ,'disabled']) }}
                                </div><!--col-lg-10-->
                            </div><!--form control-->

                            <div class="form-group">
                                {{ Form::label('account_number', 'Số tài khoản',
                                 ['class' => 'col-lg-3 control-label']) }}

                                <div class="col-lg-9">
                                    {{ Form::text('account_number', old('account_number'), ['class' => 'form-control', 'maxlength' => '255', 'required' => 'required', 'placeholder' => 'Số tài khoản' ,'disabled']) }}
                                </div><!--col-lg-10-->
                            </div><!--form control-->
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="box-body">
                            <div class="form-group">
                                {{ Form::label('user_id', 'Mã nhân viên', ['class' => 'col-lg-3 control-label']) }}
                                <div class="col-lg-9">
                                    {{ Form::text('user_id', App\Helpers\Backend\Utilities::getPID(auth()->user()->id) , ['class' => 'form-control', 'maxlength' => '255', 'required' => 'required', 'placeholder' => 'Mã nhân viên'   ,'disabled']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('user_name', 'Tên nhân viên', ['class' => 'col-lg-3 control-label']) }}
                                <div class="col-lg-9">
                                    {{ Form::text('user_name', auth()->user()->first_name . " " . auth()->user()->last_name , ['class' => 'form-control', 'maxlength' => '255', 'required' => 'required', 'placeholder' => 'Mã nhân viên'   ,'disabled']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('service', 'Loại dịch vụ', ['class' => 'col-lg-3 control-label']) }}
                                <div class="col-lg-9">
                                    <select name="service" id="service" class="form-control">
                                        @foreach($service_list as $item)
                                            <option value="{!! $item->id !!}">{!! $item->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('datetime', 'Ngày tháng',
                                 ['class' => 'col-lg-3 control-label']) }}

                                <div class="col-lg-9">
                                    {{ Form::text('datetime', old('datetime'), ['class' => 'form-control', 'maxlength' => '32', 'required' => 'required', 'placeholder' => 'Ngày phát sinh doanh thu']) }}
                                </div>
                            </div>

                            <div class="form-group ">
                                {{ Form::label('revenue', 'Doanh thu',
                                 ['class' => 'col-lg-3 control-label']) }}

                                <div class="col-lg-9 m-money">
                                    <div class="m-tooltip"></div>
                                    {{ Form::number('revenue', old('revenue'), ['class' => 'form-control', 'maxlength' => '32', 'min' =>'1' , 'required' => 'required', 'placeholder' => 'Doanh thu' , 'step'=>'any']) }}

                                </div>
                            </div>

                            <div class="form-group ">
                                {{ Form::label('profit', 'Lợi nhuận',
                                 ['class' => 'col-lg-3 control-label']) }}

                                <div class="col-lg-9 m-money">
                                    <div class="m-tooltip"></div>
                                    {{ Form::number('profit', old('profit'), ['class' => 'form-control', 'maxlength' => '32', 'min' =>'1' ,'required' => 'required', 'placeholder' => 'Lợi nhuận', 'step'=>'any']) }}

                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('percent', 'Tỉ lệ %',
                                 ['class' => 'col-lg-3 control-label']) }}

                                <div class="col-lg-9">
                                    {{ Form::text('percent', "", ['class' => 'form-control', 'maxlength' => '32', 'disabled' => 'disabled', 'placeholder' => 'tỉ lệ % lợi nhuận/doanh thu ']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        </div>
    </div>
@endsection

@section('after-scripts')
    {{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js') }}
    <script>

        $(document).on('mouseenter','.m-money' , function () {
            var value = $(this).find('input').val();
            if (!value){
                $(this).find('.m-tooltip').text('Chưa nhập giá trị');
                $('#percent').val('');
            }else{
                value = (value + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
                $(this).find('.m-tooltip').text(value);
            }
        });

        $(document).on('keyup' , '.m-money input' , function () {
            var value2 = $(this).val();
            if (!value2){
                $(this).prev().text('Chưa nhập giá trị');
                $('#percent').val('');
            }else{
                value2 = (value2 + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
                $(this).prev().text(value2);
                if($('#profit').val() > 0 && $('#revenue').val() > 0 ){

                    var percent = parseFloat($('#revenue').val())/parseFloat($('#profit').val());

                    $('#percent').val(percent.toFixed(2));
                }
            }
        });

        $.datetimepicker.setLocale('vi');

        $('#datetime').datetimepicker({
            format:'d-m-Y H:i'
        });

        $(document).on('keyup' , '#company' , function (e) {
            e.preventDefault();
            var value = $(this).val().trim();
            if (value.length > 0){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:"post",
                    url:"{{route('admin.personnel.revenues.ajax.suggestion')}}",
                    data:{'value':value},
                    success:function(data){
                        if (data.status == true){
                            $('#suggesstion-box').html(data.data_column).css('display','block');
                            $(document).on('click' , '.list_company' , function (e) {
                                e.preventDefault();
                                var id = $(this).data('id');
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    type:"post",
                                    url:"{{route('admin.personnel.revenues.ajax.suggestion.detail')}}",
                                    data:{'id':id},
                                    success:function(data){
                                        if (data.status == true){
                                            $('#company_id').val(data.company.id);
                                            $('#company').val(data.company.company_name);
                                            $('#advisor').val(data.company.person_charge);
                                            $('#email').val(data.company.email_address);
                                            $('#phone').val(data.company.phone_number);
                                            $('#address').val(data.company.address);
                                            $('#tax_identification').val(data.company.tax_identification_number);
                                            $('#account_number').val(data.company.account_number);
                                            $('#suggesstion-box').html("").css('display','none');
                                        }else{
                                            $('#company_id').val("");
                                            $('#company').val("");
                                            $('#advisor').val("");
                                            $('#email').val("");
                                            $('#phone').val("");
                                            $('#address').val("");
                                            $('#tax_identification').val("");
                                            $('#account_number').val("");
                                            $('#suggesstion-box').html("").css('display','none');
                                        }
                                    },
                                    cache:false,
                                    dataType: 'json'
                                });
                            });
                        }else{
                            $('#suggesstion-box').html("").css('display','none');
                        }
                    },
                    cache:false,
                    dataType: 'json'
                });
            }else{
                $('#suggesstion-box').html("").css('display','none');
            }
        });

    </script>
@endsection

@section('after-styles')
    {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css') }}
    <style>
        .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
        .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
        .autocomplete-selected { background: #F0F0F0; }
        .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
        .autocomplete-group { padding: 2px 5px; }
        .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
    </style>
@endsection
