@foreach($domainHostingDatas as $data)
    <tr id="domain_and_host_content_data_{{$data->id}}">
        <th>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownWebsiteTask"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownWebsiteTask">
                    <div class="bg-white py-2">
                        @can('domain-hosting-manager.edit')
                            <a class="dropdown-item edit_domain_and_host" data-id="{{$data->id}}"
                               data-url="{{route("domain-hosting-manager.edit",["id"=>$data->id])}}" href="#">Edit</a>
                        @endcan
                        @can('domain-hosting-manager.delete')
                            <a class="dropdown-item text-danger delete_domain_and_host" data-id="{{$data->id}}"
                               data-url="{{route("domain-hosting-manager.delete",["id"=>$data->id])}}"
                               href="#!">Delete</a>
                        @endcan
                    </div>
                </div>
            </div>
        </th>
        <td class="white-space-preline-report">{{!empty($data->type)?$types->where('id',$data->type)->first()->name:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->name)?$data->name:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->link)?$data->link:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->user)?$data->user:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->password)?$data->password:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->provider)?$data->provider:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->person_in_charge)?$admins[$data->person_in_charge]:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->email_in_charge)?$data->email_in_charge:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->expiry_date)?convert_date_form_db($data->expiry_date):''}}</td>
        <td class="white-space-preline-report">{{!empty($data->fee)?$data->fee:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->note)?$data->note:''}}</td>
    </tr>
@endforeach
