@extends ('backend.layouts.app')

@section ('title', 'Document_Detail')

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
    <h1>
        {{$document_detail->document_name}}
    </h1>
@endsection

@section('content')
        <div>
            {!! $document_detail->document_content !!}
        </div><!-- /.box-header -->

@endsection

@section('after-scripts')
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}
@endsection
