<div class="table-responsive">
    <table class="table table-condensed table-hover table-bordered">
        <thead>
        <tr>
            <th>Công Ty</th>
            <th>Dịch vụ</th>
            <th>Doanh thu</th>
            <th>Lợi nhuận</th>
            <th>Ngày tháng</th>
            <th>Tác vụ</th>
        </tr>
        </thead>
        <tbody>
        @foreach($revenues as $revenue)
            @php
                $company_name = App\Models\Company::find($revenue->company_id);
            @endphp
            <tr>
                <td>{{ $company_name->company_name }}</td>
                <td>{{ $revenue->service->name }}</td>
                <td>{{ number_format($revenue['revenue'],0, '' , ' ') }}</td>
                <td>{{ number_format($revenue['profit'],1, ',' , ' ') }}</td>
                <td>{{ date('d-m-Y H:i', strtotime($revenue['datetime'])) }}</td>
                <td><a target="_blank" href="{{ route('admin.personnel.revenues.getEdit', ['id' => $revenue['id']]) }}"
                       class="btn btn-primary btn-xs">Thay đổi</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>