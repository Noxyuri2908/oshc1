<table class="table table-md mb-0 table-dashboard fs--1 tab-data-receipt">
    <thead class="bg-200 text-900">
    <tr>
        <th class="status">Agent</th>
        <th class="status">Commission</th>
        <th class="status">Visa status</th>
        <th class="status">Month</th>
        <th class="status">Date of payment</th>
        <th class="status">Profit status</th>
        <th class="status">Provider</th>
        <th class="status">Provider</th>
        <th class="status">Issue date</th>
        <th class="status">Created by</th>
        <th class="status">Creation date</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($obj))
        <tr>
            <td>
                {{$agent->name}}
            </td>
            <td>
                {{$comm->comm}}%
            </td>
            <td>
                {{!empty($obj->profit->first()) ? getValueByIndexConfig(config('myconfig.status_visa'),$obj->profit->first()->visa_status) : ''}}
            </td>
            <td>
                {{!empty($obj->profit->first()) ? $obj->profit->first()->visa_month : ''}}
            </td>
            <td>
                {{(!empty($obj->hoahong->date_payment_provider))?convert_date_form_db($obj->hoahong->date_payment_provider):''}}
            </td>
            <td>
                {{!empty($obj->profit->first()) ?  ($obj->profit->first()->profit_status == 1 ? 'Done' : 'Refund') : ''}}
            </td>
            <td>
                {{$obj->provider != null ? $obj->provider->name : ''}}
            </td>
            <td>
                {{$obj->hoahong->policy_no}}
            </td>
            <td>
                {{(!empty($issueDate))?convert_date_form_db($issueDate):''}}
            </td>
            <td>
                {{$creater}}
            </td>
            <td>
                {{!empty($obj->hoahong->created_at) ? convert_date_form_db($obj->hoahong->created_at) : ''}}
            </td>
        </tr>
    @else
        <tr>
            <td colspan="16">No data !</td>
        </tr>
    @endif

    </tbody>
</table>
