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
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Quản lý quyền</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <a href="{{url('admin/access/permission/add')}}" class="btn btn-success btn-xs">Tạo quyền</a>
            <div class="table-responsive">
                <table id="users-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Quyền</th>
                            <th>Hành động</th>
                        </tr>

                        @foreach($permission as $list)
                            <?php $id = $id + 1;?>
                            <tr>
                                <td>{{$id}}</td>
                                <td>{{$list->display_name}}</td>
                                <td>
                                    <a href="{{url('admin/access/permission/edit/'.$list->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i>Sửa</a>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa')" href="{{url('admin/access/permission/delete/'.$list->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </thead>
                </table>
                {{$permission->links()}}
            </div>
        </div>
    </div>

@endsection

@section('after-scripts')
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}
@endsection
