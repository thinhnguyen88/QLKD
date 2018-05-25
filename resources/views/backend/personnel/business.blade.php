@extends ('backend.layouts.app_ajax')

@section ('title', 'Hoạt động kinh doanh')

@section('page-header')
    <h1>
        Hoạt động kinh doanh
    </h1>
    <style>
        .textCenter {
            text-align: center;
        }

        .textCenter a {
            font-weight: 500;
        }

        .report {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Danh sách</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div role="tabpanel">
                <div>

                    <a href="{!! route('admin.personnel.business.plan.business') !!}" class="btn btn-warning btn-xs">Kế
                        hoạch doanh số</a>

                    @if(access()->user()->hasRole('Kỹ thuật') || access()->user()->hasRole('Giám đốc') || access()->user()->hasRole('Trưởng phòng'))
                        <a id="excel" data-page="1"
                           class="btn btn-primary btn-xs">In báo cáo doanh thu</a>
                    @endif

                    @if((int)access()->user()->goal > 0)
                        <a target="_blank" href="{{ route('admin.personnel.revenues.getAdd') }}"
                           class="btn btn-success btn-xs">Nhập doanh thu</a>
                    @endif

                </div>
                @if(access()->user()->hasRole('Kỹ thuật') || access()->user()->hasRole('Giám đốc') || access()->user()->hasRole('Trưởng phòng'))
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-lg-12">
                            <div class="form-group col-lg-4">
                                <select name="" id="business_change_field" class="form-control  ">
                                    <option disabled selected value="0">Lựa chọn tiêu chí</option>
                                    <option value="name">Tên nhân viên</option>
                                    <option value="id">Mã nhân viên</option>
                                    <option value="goal">Chỉ tiêu tháng</option>
                                    <option value="daily_revenues">Doanh thu trong ngày</option>
                                    <option value="revenue_by_goal">Doanh thu theo chỉ tiêu tháng</option>
                                    <option value="monthly_revenues_accumulated">Doanh thu lũy kế tháng</option>
                                    <option value="quarter_revenues_accumulated">Doanh thu lũy kế quý</option>
                                    <option value="yearly_revenues_accumulated">Doanh thu trong năm</option>
                                    <option value="monthly_revenues_ratio">% doanh thu tháng</option>
                                    <option value="quarter_revenues_ratio">% doanh thu quý</option>
                                    <option value="yearly_revenues_ratio">% doanh thu năm</option>
                                    <option value="monthly_revenues_lack">Doanh thu còn thiếu so với kế hoạch tháng
                                    </option>
                                    <option value="quarter_revenues_lack">Doanh thu còn thiếu so với kế hoạch quý
                                    </option>
                                    <option value="yearly_revenues_lack">Doanh thu còn thiếu so với kế hoạch năm
                                    </option>
                                    <option value="monthly_revenues_vs_1st">Doanh thu còn thiếu so với người thứ 1
                                        tháng
                                    </option>
                                    <option value="yearly_revenues_lack">Doanh thu còn thiếu so với người thứ 1 quý
                                    </option>
                                    <option value="yearly_revenues_lack">Doanh thu còn thiếu so với người thứ 1 năm
                                    </option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <select name="" id="orderBy" class="form-control" style="float: left">
                                    <option value="desc">Giảm dần</option>
                                    <option value="asc">Tăng dần</option>
                                </select>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="clearfix"></div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane mt-30 active">
                        <div class="table-responsive" id="content_table">
                            <table class="table table-condensed table-hover table-bordered textCenter"
                                   style="max-width: none; width: 200%">
                                <thead>
                                <tr class="textCenter">
                                    <th class="textCenter report"><input type="checkbox" id="all" name="stt"
                                                                         value="0"><span
                                                style="color:  #72afd2">All</span></th>
                                    <th class="textCenter"><a>Ảnh</a></th>
                                    <th class="textCenter"><a>Tên</a></th>
                                    <th class="textCenter"><a>Mã NV</a></th>
                                    <th class="textCenter"><a>Kế hoạch chỉ tiêu tháng</a></th>
                                    <th class="textCenter"><a>Doanh thu trong ngày</a></th>
                                    <th class="textCenter"><a>Doanh thu theo chỉ tiêu tháng</a></th>
                                    <th class="textCenter"><a>Doanh thu lũy kế</a></th>
                                    <th class="textCenter"><a>% doanh thu</a></th>
                                    <th class="textCenter"><a>Doanh thu còn thiếu so với kế hoạch</a></th>
                                    <th class="textCenter"><a>Doanh thu so với người thứ nhất</a></th>
                                    <th class="textCenter"><a>Xếp hạng</a></th>
                                    <th><a>Chi tiết</a></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($stt=0)
                                @foreach($users as $user)
                                    @php
                                        if (!isset($user['id']))
                                        {
                                            continue;
                                        }
                                           $stt++;
                                    @endphp
                                    <tr>
                                        <td class="report"><p style="margin: 0px">{{  $stt }}</p>
                                            <input type="checkbox" class="stt" name="stt" value="{{$user['id']}}">
                                        </td>
                                        <td><img class="avatar-img" src="{{ $user['avatar'] }}"></td>
                                        <td>{{ $user['name'] }}</td>
                                        <td>{{ App\Helpers\Backend\Utilities::getPID($user['id']) }}</td>
                                        <td>{{ number_format($user['goal'],2,',',' ') }} đ</td>
                                        <td>{{ number_format($user['daily_revenues'] , 0 , '' , '.') }} đ</td>
                                        <td>{{ number_format($user['revenue_by_goal'], 2 , ',' , '.') }} đ</td>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Tháng</td>
                                                    <td>Quý</td>
                                                    <td>Năm</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ number_format($user['monthly_revenues_accumulated'] , 2 , ',' , '.') }}
                                                        đ
                                                    </td>
                                                    <td>{{ number_format($user['quarter_revenues_accumulated'],2,',','.') }}
                                                        đ
                                                    </td>
                                                    <td>{{ number_format($user['yearly_revenues_accumulated'],2,',','.') }}
                                                        đ
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Tháng</td>
                                                    <td>Quý</td>
                                                    <td>Năm</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ number_format($user['monthly_revenues_ratio'], 2 , ',' , '.') }}
                                                        %
                                                    </td>
                                                    <td>{{ number_format($user['quarter_revenues_ratio'], 2 , ',' , '.') }}
                                                        %
                                                    </td>
                                                    <td>{{ number_format($user['yearly_revenues_ratio'], 2 , ',' , '.') }}
                                                        %
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Tháng</td>
                                                    <td>Quý</td>
                                                    <td>Năm</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ number_format($user['monthly_revenues_lack'] , 0 , '' ,'.') }}</td>
                                                    <td>{{ number_format($user['quarter_revenues_lack'] , 0 , '' ,'.') }}</td>
                                                    <td>{{ number_format($user['yearly_revenues_lack'] , 0 , '' ,'.') }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Tháng</td>
                                                    <td>Quý</td>
                                                    <td>Năm</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ number_format($user['monthly_revenues_vs_1st'],0,'','.') }}</td>
                                                    <td>{{ number_format($user['quarter_revenues_vs_1st'],0,'','.') }}</td>
                                                    <td>{{ number_format($user['yearly_revenues_vs_1st'],0,'','.') }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Theo doanh thu</td>
                                                    <td>Theo số khách hàng</td>
                                                    <td>Theo lợi nhuận</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ $user['ranking_by_count_company'] }}/{{ $total_sales }}</td>
                                                    <td>{{ $user['ranking_by_monthly_revenues_accumulated'] }}
                                                        /{{ $total_sales }}</td>
                                                    <td>{{ $user['ranking_by_monthly_profit_accumulated'] }}
                                                        /{{ $total_sales }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <a data-fancybox data-type="ajax"
                                               data-src="{{ route('admin.personnel.revenues.index', ['id' => $user['id']]) }}"
                                               href="javascript:void(0);"
                                               class="btn btn-info btn-xs">Chi tiết</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $paginator_html !!}
                        </div>
                    </div><!--tab panel profile-->
                </div><!--tab content-->

            </div><!--tab panel-->
        </div>
    </div>


@endsection


@section('after-styles')
    <style>
        .avatar-img {
            width: 50px;
        }

    </style>

    {{ Html::style("https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.css") }}
@endsection

@section('after-scripts')

    {{ Html::script("https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.js") }}
    <script>
        $(document).ready(function () {
            var glo_page = 1;
            $(document).on('click', '#excel', function (e) {
                var orderBy = $(this).val();
                var value = $('#business_change_field').val();
                var stt = $.map($('input:checkbox:checked'), function (e, i) {
                    return +e.value;
                });
                $('th,td').removeClass("report");
                if (value == null || value == 0) {
                    alert("Bạn chưa chọn tiêu chí");
                    return;
                }
                if (stt.length < 1) {
                    alert("Chọn nhân viên cần In");
                    return;
                } else {
                    var report = stt.toString();
                }

                window.location = '/admin/personnel/business/excel/' + glo_page + '?value=' + value + '&orderBy=' + orderBy + '&report=' + report;
            });

            $("#all").click(function () {
                $(".stt").prop('checked', $(this).prop('checked'));
            });


            $(document).on('change', '#business_change_field', function (e) {
                e.preventDefault();
                var value = $(this).val();
                var orderBy = $('#orderBy').val();
                var page = 1;
                ajax(value, orderBy, page);
            });

            $(document).on('change', '#orderBy', function (e) {
                e.preventDefault();
                var orderBy = $(this).val();
                var value = $('#business_change_field').val();
                var page = 1;
                if (value == null || value == 0) {
                    alert("Bạn chưa chọn tiêu chí");
                    return;
                }
                ajax(value, orderBy, page);
            });

            $(document).on('click', '.on_paginate', function (e) {
                e.preventDefault();
                var orderBy = $(this).data('order');
                var value = $(this).data('value');
                var page = $(this).data('page');
                glo_page = page;
                if (!$(this).hasClass("active")) {
                    ajax(value, orderBy, page);
                }
            });

            function ajax(value, orderBy, page) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: '/admin/personnel/business/business-change-field/' + page,
                    data: {
                        'value': value,
                        'orderBy': orderBy,
                    },
                    success: function (data) {
                        if (data.status == true) {
                            $('#content_table').html(data.data);
                        }
                    },
                    cache: false,
                    dataType: 'json'
                }).done(function (html) {
                    $("#all").click(function () {
                        $(".stt").prop('checked', $(this).prop('checked'));
                    });
                });
            }
        });

    </script>
@endsection
