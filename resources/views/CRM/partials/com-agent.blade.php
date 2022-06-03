
@foreach($comms as $comm)
@if(!empty($comm))
<tr class="" data-id="{{$comm->id}}">
    <td class="white-space-break-spaces">
        <a class="edit_comm" data-id="{{$comm->id}}" href="#" title="Edit">
            <i class="fas fa-edit"></i>
        </a>
        <a class="del_comm" data-id="{{$comm->id}}" href="#" title="Delete">
            <span class="far fa-trash-alt"></span>
        </a>
    </td>
    <td class="white-space-break-spaces">{{(!empty($comm->service))?$comm->service->name:''}}</td>
    <td class="white-space-break-spaces">{{(!empty($comm->policy))?\Config::get('myconfig.policy')[$comm->policy]:''}}</td>
    <td class="text-center white-space-break-spaces">{{$comm->comm}}{{(!empty($comm->donvi))?\Config::get('myconfig.donvi')[$comm->donvi]:''}}</td>
    <td class="white-space-break-spaces">{{$comm->gst == 2?'NOT INCLUDED':'INCLUDED'}}</td>
    <td class="white-space-break-spaces">{{(!empty($comm->type_payment))?\Config::get('myconfig.type_payment')[$comm->type_payment]:''}}</td>
    <td class="white-space-break-spaces">{{convert_date_form_db($comm->validity_start_date)}}</td>
</tr>
@endif
@endforeach
