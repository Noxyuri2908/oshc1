@foreach($users as $user)
@php
$info = $user->info;
@endphp
@if($info != null)
<tr class="btn-reveal-trigger data-agent" data-id="{{$user->id}}">
  <td class="align-middle">
    <input class="ml-3 sub_chk" data-id="{{$user->id}}" type="checkbox" aria-label="Checkbox for this row" />
  </td>
  <td class="align-middle  text-center">
    <div class="dropdown text-sans-serif">
        <button class="btn btn-link text-600 btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="fas fa-ellipsis-h fs--1"></span>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item agent_info" href="#!" data-id="{{$user->id}}">View</a>
            <a class="dropdown-item" href="{{route('agent.edit', ['id'=>$user->id])}}">Edit</a>
            <a class="dropdown-item" href="{{route('agent.process', ['id'=>$user->id])}}" data-id="{{$user->id}}">Process</a>
            <div class="dropdown-divider"> </div>
            <a class="dropdown-item text-danger modal_delete" data-id="{{$user->id}}" href="#!">Delete</a>
        </div>
    </div>
  </td>
  <td class="align-middle  text-center"><a style="cursor: pointer; color: blue" class="agent_info" data-id="{{$user->id}}">{{$user->name}}</a></td>
  <td class="align-middle  text-center"><a style="cursor: pointer; color: blue" class="agent_info" data-id="{{$user->id}}">{{$info->agent_code}}</a></td>
  <td class="align-middle  text-center">{{$info->text_type_agent}}</td>
  <td class="align-middle  text-center">{{$user->text_status}}</td>
  <td class="align-middle  text-center">{{$info->text_market}}</td>
  <td class="align-middle  text-center">{{$user->email}}</td>
  <td class="align-middle  text-center">{{$info->tel_1}}</td>
  <td class="align-middle  text-center">{{$info->tel_2}}</td>
  <td class="align-middle  text-center">{{$info->website}}</td>
  <td class="align-middle  text-center">{{$info->text_country}}</td>
  <td class="align-middle  text-center">{{$info->city}}</td>
  <td class="align-middle  text-center">{{$info->office}}</td>
  <td class="align-middle  text-center">{{$info->text_department}}</td>
  <td class="align-middle  text-center">@if($info->person != null)<a class="contact_info" href="#!" data-id="{{$info->person->id}}"> {{$info->person->name}}</a>@endif</td>
  <td></td>
  <td class="align-middle  text-center"><a href="#" class="agent_comm" data-id="{{$user->id}}"><span class="far fa-eye"></span></a></td>
  <td class="text-center"></td>
  <td class="align-middle  text-center">{{$info->registered_date}}</td>
  <td class="align-middle  text-center">{{$user->created_at}}</td>
</tr>
@endif
@endforeach
