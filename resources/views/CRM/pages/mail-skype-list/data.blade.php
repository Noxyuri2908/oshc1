@foreach($mailSkypeDatas as $data)
    <tr id="mail_and_skype_content_data_{{$data->id}}">
        <th>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownWebsiteTask"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownWebsiteTask">
                    <div class="bg-white py-2">
                        @can('email-skype-manager.edit')
                            <a class="dropdown-item edit_mail_and_skype" data-id="{{$data->id}}"
                               data-url="{{route("email-skype-manager.edit",["id"=>$data->id])}}" href="#">Edit</a>
                        @endcan
                        @can('email-skype-manager.delete')
                            <a class="dropdown-item text-danger delete_mail_and_skype" data-id="{{$data->id}}"
                               data-url="{{route("email-skype-manager.delete",["id"=>$data->id])}}" href="#!">Delete</a>
                        @endcan
                    </div>
                </div>
            </div>
        </th>
        <td class="white-space-preline-report">{{!empty($data->domain_id)?$domains->where('id',$data->domain_id)->first()->name:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->email)?$data->email:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->person_in_charge)?$admins[$data->person_in_charge]:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->password)?$data->password:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->skype)?$data->skype:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->crm)?$data->crm:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->dropbox)?$data->dropbox:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->note)?$data->note:''}}</td>
    </tr>
@endforeach
