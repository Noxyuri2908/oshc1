@foreach($websiteAndAccountDatas as $data)
    <tr id="website_account_data_{{$data->id}}">
        <th>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownWebsiteTask"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownWebsiteTask">
                    <div class="bg-white py-2">
                        @if($typeId == 1)
                            @can('website-account-manager.edit')
                                <a class="dropdown-item edit_website_and_account" data-id="{{$data->id}}"
                                   data-url="{{route("website-account-manager.edit",["id"=>$data->id,'typeId'=>$typeId])}}"
                                   href="#">Edit</a>
                            @endcan
                            @can('website-account-manager.delete')
                                <a class="dropdown-item text-danger delete_website_and_account" data-id="{{$data->id}}"
                                   data-url="{{route("website-account-manager.delete",["id"=>$data->id,'typeId'=>$typeId])}}"
                                   href="#!">Delete</a>
                            @endcan
                        @elseif($typeId == 2)
                            @can('serviceAccount.edit')
                                <a class="dropdown-item edit_website_and_account" data-id="{{$data->id}}"
                                   data-url="{{route("website-account-manager.edit",["id"=>$data->id,'typeId'=>$typeId])}}"
                                   href="#">Edit</a>
                            @endcan
                            @can('serviceAccount.delete')
                                <a class="dropdown-item text-danger delete_website_and_account" data-id="{{$data->id}}"
                                   data-url="{{route("website-account-manager.delete",["id"=>$data->id,'typeId'=>$typeId])}}"
                                   href="#!">Delete</a>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </th>
        @if($typeId == 1)
            <td class="white-space-preline-report">{{!empty($data->website)?$data->website:''}}</td>
        @elseif($typeId == 2)
            <td class="white-space-preline-report">{{!empty($data->service)?$data->service:''}}</td>
        @endif
        <td class="white-space-preline-report">{{!empty($data->link)?$data->link:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->website_and_service_id)?$data->website_and_service_id:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->password)?$data->password:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->supporter)?$data->supporter:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->note)?$data->note:''}}</td>
    </tr>
@endforeach
