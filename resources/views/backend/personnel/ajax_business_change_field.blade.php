<table class="table table-condensed table-hover table-bordered textCenter"
       style="max-width: none; width: 200%">
    <thead>
    <tr class="textCenter">
        <th class="textCenter report"><input id="all" type="checkbox" name="stt" style="color: #72afd2" value="0"><span style="color: #3c8dbc">All</span></th>
        <th class="textCenter"><a>Ảnh</a></th>
        <th class="textCenter"><a>Tên</a> </th>
        <th class="textCenter"><a>Mã NV</a></th>
        <th class="textCenter"><a>Kế hoạch chỉ tiêu tháng</a> </th>
        <th class="textCenter"><a>Doanh thu trong ngày</a> </th>
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
        @foreach($users as $key => $user)
            @php
                $stt++;
            @endphp
            <tr @if($key < 3) class="info"  @endif >
                <td class="report"><p style="margin: 0px">{{  $stt }}</p>
                    <input type="checkbox" name="stt" class="stt" value="{{$user['id']}}">
                </td>
                <td><img class="avatar-img" src="{{ $user['avatar'] }}"></td>
                <td>{{ $user['name'] }}</td>
                <td>{{ App\Helpers\Backend\Utilities::getPID($user['id']) }}</td>
                <td>{{ number_format($user['goal'],2,',',' ') }} đ</td>
                <td>{{ number_format($user['daily_revenues'] , 0 , '' , '.') }} đ</td>
                <td>{{ number_format($user['revenue_by_goal'], 2 , ',' , '.') }} đ</td>
                <td>
                    <table class="table table-bordered">
                        <tr @if($key < 3)  class="info" @endif>
                            <td>Tháng</td>
                            <td>Quý</td>
                            <td>Năm</td>
                        </tr>
                        <tr @if($key < 3)  class="info" @endif>
                            <td>{{ number_format($user['monthly_revenues_accumulated'] , 2 , ',' , '.') }} đ</td>
                            <td>{{ number_format($user['quarter_revenues_accumulated'],2,',','.') }} đ</td>
                            <td>{{ number_format($user['yearly_revenues_accumulated'],2,',','.') }} đ</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table table-bordered">
                        <tr @if($key < 3)  class="info" @endif>
                            <td>Tháng</td>
                            <td>Quý</td>
                            <td>Năm</td>
                        </tr>
                        <tr @if($key < 3)  class="info" @endif>
                            <td>{{ number_format($user['monthly_revenues_ratio'], 2 , ',' , '.') }} %</td>
                            <td>{{ number_format($user['quarter_revenues_ratio'], 2 , ',' , '.') }} %</td>
                            <td>{{ number_format($user['yearly_revenues_ratio'], 2 , ',' , '.') }} %</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table table-bordered">
                        <tr @if($key < 3)  class="info" @endif>
                            <td>Tháng</td>
                            <td>Quý</td>
                            <td>Năm</td>
                        </tr>
                        <tr @if($key < 3)  class="info" @endif>
                            <td>{{ number_format($user['monthly_revenues_lack'] , 0 , '' ,'.') }}</td>
                            <td>{{ number_format($user['quarter_revenues_lack'] , 0 , '' ,'.') }}</td>
                            <td>{{ number_format($user['yearly_revenues_lack'] , 0 , '' ,'.') }}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table table-bordered">
                        <tr @if($key < 3)  class="info" @endif>
                            <td>Tháng</td>
                            <td>Quý</td>
                            <td>Năm</td>
                        </tr>
                        <tr @if($key < 3)  class="info" @endif>
                            <td>{{ number_format($user['monthly_revenues_vs_1st'],0,'','.') }}</td>
                            <td>{{ number_format($user['quarter_revenues_vs_1st'],0,'','.') }}</td>
                            <td>{{ number_format($user['yearly_revenues_vs_1st'],0,'','.') }}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table  class="table table-bordered">
                        <tr @if($key < 3)  class="info" @endif>
                            <td>Theo doanh thu</td>
                            <td>Theo số khách hàng</td>
                            <td>Theo lợi nhuận</td>
                        </tr>
                        <tr @if($key < 3)  class="info" @endif>
                            <td>{{ $user['ranking_by_count_company'] }}/{{ $total_sales }}</td>
                            <td>{{ $user['ranking_by_monthly_revenues_accumulated'] }}/{{ $total_sales }}</td>
                            <td>{{ $user['ranking_by_monthly_profit_accumulated'] }}/{{ $total_sales }}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <a data-fancybox data-type="ajax" data-src="{{ route('admin.personnel.revenues.index', ['id' => $user['id']]) }}" href="javascript:void(0);"
                       class="btn btn-info btn-xs">Chi tiết</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@if($paginator_html)
    <ul class="pagination">
        @if($paginator_html->getPrevPage())
            <li  class="on_paginate" data-page="{!! $paginator_html->getPrevPage() !!}" data-value="{!! $value !!}" data-order="{!! $order !!}" ><a>&laquo; Previous</a></li>
        @endif
        @for($i = 1 ; $i <= $paginator_html->getNumPages(); $i ++)
            <li  class="@if($i == $paginator_html->getCurrentPage()) active @endif on_paginate" data-page="{!! $i !!}" data-value="{!! $value !!}" data-order="{!! $order !!}" ><a>{!! $i !!}</a></li>
        @endfor
        @if($paginator_html->getNextPage())
                <li  class="on_paginate" data-page="{!! $paginator_html->getNextPage() !!}" data-value="{!! $value !!}" data-order="{!! $order !!}" ><a>Next &raquo;</a></li>
        @endif
    </ul>
@endif