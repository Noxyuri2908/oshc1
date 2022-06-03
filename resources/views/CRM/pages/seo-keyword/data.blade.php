@foreach($seoKeywordDatas as $data)
    <tr id="domain_and_host_content_data_{{$data->id}}">
        <th>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownWebsiteTask"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownWebsiteTask">
                    <div class="bg-white py-2">
                        @can('seo-keyword.edit')
                            <a class="dropdown-item edit_seo_keyword" data-id="{{$data->id}}"
                               data-url="{{route("seo-keyword.edit",["id"=>$data->id])}}" href="#">Edit</a>
                        @endcan
                        @can('seo-keyword.delete')
                            <a class="dropdown-item text-danger delete_seo_keyword" data-id="{{$data->id}}"
                               data-url="{{route("seo-keyword.delete",["id"=>$data->id])}}" href="#!">Delete</a>
                        @endcan
                    </div>
                </div>
            </div>
        </th>
        <td class="white-space-preline-report">{{!empty($data->destination_target)?$data->destination_target:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->keyword)?$data->keyword:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->relevant_info)?$data->relevant_info:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->gg_ad)?$data->gg_ad:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->ranking)?$data->ranking:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->link)?$data->link:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->title)?$data->title:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->description)?$data->description:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->note)?$data->note:''}}</td>
    </tr>
@endforeach
