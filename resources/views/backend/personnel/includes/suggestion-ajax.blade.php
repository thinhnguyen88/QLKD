@if(sizeof($company_list) > 0)
    @foreach($company_list as $item)
        @php
            $id = App\Helpers\Backend\Utilities::getCompanyId($item->id)
        @endphp
        <ul class="list-group" style="margin-bottom: 0px !important;" >
            <li class="list-group-item list_company" data-id=" {!! $item->id !!}">{!! $id !!} -- {!! $item->company_name  !!} </li>
        </ul>
    @endforeach
@endif