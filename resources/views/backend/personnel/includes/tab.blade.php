<!-- Nav tabs -->
@php($route_name = Route::currentRouteName())
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" {!! str_contains($route_name, 'admin.personnel.users') ? 'class="active"' : ''  !!}>
        <a href="{{ route('admin.personnel.users.index') }}" role="tab">{!! trans('labels.backend.personnel.tab.personnel_list') !!}</a>
    </li>
    <li role="presentation" {!! str_contains($route_name, 'admin.personnel.business') ? 'class="active"' : ''  !!}>
        <a href="{{ route('admin.personnel.business.index') }}" role="tab">{!! trans('labels.backend.personnel.tab.business_activities') !!}</a>
    </li>
    <li role="presentation" {!! str_contains($route_name, 'admin.personnel.documents') ? 'class="active"' : ''  !!}>
        <a href="{{ route('admin.personnel.documents.index') }}" role="tab">{!! trans('labels.backend.personnel.tab.form_download') !!}</a>
    </li>
</ul>