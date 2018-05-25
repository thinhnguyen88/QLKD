@extends ('backend.layouts.app')

@section ('title', 'Kế hoạch kinh doanh')

@section('page-header')
    <h1>
        Kế hoạch kinh doanh
    </h1>
@endsection

@section('content')
    <style>
        #line {
            background-image: linear-gradient(
                    to top right,
                    white 50%,
                    #3E8DBA,
                    white 54%
            );
        }
    </style>

    <div class="box box-success">
        <div class="box-header with-border">
            @if(access()->user()->hasRoles(['Kỹ thuật', 'Giám đốc', 'Trưởng phòng']))
                <h3 class="box-title">Danh sách</h3>

                <form action="{!! route('admin.personnel.business.search.plan.business') !!}" method="get">
                    <div style="margin-top: 10px">
                        <div class="form-group col-lg-4">
                            <input type="text" name="multi_column" class="form-control" placeholder="Tìm kiếm theo mã hoặc tên nhân viên">
                        </div>
                        <div class="form-group col-lg-4">
                            <input type="submit" class="btn btn-info" value="Tìm kiếm">
                        </div>
                    </div><!--box-tools pull-right-->
                </form>
            @endif
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Quý</th>
                        <th colspan="3">Quý I</th>
                        <th colspan="3">Quý II</th>
                        <th colspan="3">Quý III</th>
                        <th colspan="3">Quý IV</th>
                    </tr>
                    <tr>
                        <th id="line">N.Viên</th>
                        @foreach($list_monthly as $key => $item)
                            <th>{!! ucwords($item) !!}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @php($month = 0)
                    @foreach($users as $key => $item2)
                        @php($month++)
                        <tr style="text-align: center">
                            <th>{!! $item2[1]['username'] !!}</th>
                            @foreach($list_monthly as $key2 => $item3)
                                <td class="@if((int)$item2[$key2+1]['revenue_goal'] < 0 || (int)$item2[$key2+1]['goal'] == (int)$item2[$key2+1]['revenue'])bg-success   @elseif((int)$item2[$key2+1]['revenue_goal'] == 0 && (int)$item2[$key2+1]['goal'] != (int)$item2[$key2+1]['revenue']) bg-faded @else bg-danger  @endif">
                                    <span class="text-success">{!! number_format($item2[$key2+1]['revenue'] , 2 ,',' , '.') !!} <sup>VNĐ</sup></span>
                                    <div style="clear: both; border: 0.5px solid #3c763d"  ></div>
                                    <span class="text-danger">
                                        {!! number_format($item2[$key2+1]['goal'] , 2 ,',' , '.') !!} <sup>VNĐ</sup>
                                    </span>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div>
    </div>
@endsection

