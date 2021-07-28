@foreach($googleAdwordMediaDatas as $data)
    <tr id="google_adword_media_content_data_{{$data->id}}">
        <th>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownWebsiteTask"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownWebsiteTask">
                    <div class="bg-white py-2">
                        <a class="dropdown-item edit_google_adword_media" data-id="{{$data->id}}" data-url="{{route("google-adword-media.edit",["id"=>$data->id])}}" href="#">Edit</a>
                        <a class="dropdown-item text-danger delete_google_adword_media" data-id="{{$data->id}}" data-url="{{route("google-adword-media.delete",["id"=>$data->id])}}" href="#!">Delete</a>
                    </div>
                </div>
            </div>
        </th>
        <td class="white-space-preline-report">{{!empty($data->start_date)?convert_date_form_db($data->start_date):''}}</td>
        <td class="white-space-preline-report">{{!empty($data->end_date)?convert_date_form_db($data->end_date):''}}</td>
        <td class="white-space-preline-report">{{!empty($data->getWebsiteName())?$data->getWebsiteName():''}}</td>
        <td class="white-space-preline-report">{{!empty($data->campaign)?$data->campaign:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->location_search)?$data->location_search:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->getCountryName())?$data->getCountryName():''}}</td>
        <td class="white-space-preline-report">{{!empty($data->type_campaign)?$data->type_campaign:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->bid_price)?$data->bid_price:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->keyword)?$data->keyword:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->title_1)?$data->title_1:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->title_2)?$data->title_2:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->title_3)?$data->title_3:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->describe)?$data->describe:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->link_post)?$data->link_post:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->number_days)?$data->number_days:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->budget)?$data->budget:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->number_click_expected)?$data->number_click_expected:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->number_click_reality)?$data->number_click_reality:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->number_impression)?$data->number_impression:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->average_CPC)?$data->average_CPC:''}}</td>
    </tr>
@endforeach
