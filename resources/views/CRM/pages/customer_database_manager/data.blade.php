@foreach($customerDatas as $data)
    <tr id="customer_data_{{$data->id}}">
        <th>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownWebsiteTask"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownWebsiteTask">
                    <div class="bg-white py-2">
                        @can('customerManager.edit')
                            <a class="dropdown-item edit_customer" data-id="{{$data->id}}"
                               data-url="{{route("customer_database_manager.edit",["id"=>$data->id])}}"
                               href="#">Edit</a>
                        @endcan
                        @can('customerManager.delete')
                            <a class="dropdown-item text-danger delete_customer" data-id="{{$data->id}}"
                               data-url="{{route("customer_database_manager.delete",["id"=>$data->id])}}" href="#!">Delete</a>
                        @endcan
                    </div>
                </div>
            </div>
        </th>
        <td class="white-space-preline-report">{{$typeOfCustomer->where('id',$data->type_of_customer_id)->pluck('name')->first()}}</td>
        <td class="white-space-preline-report">{{$data->full_name}}</td>
        <td class="white-space-preline-report">{{$resource->where('id',$data->source_id)->pluck('name')->first()}}</td>
        <td class="white-space-preline-report">{{!empty($agents[$data->agent_id])?$agents[$data->agent_id]:''}}</td>
        <td class="white-space-preline-report">{{$englishCenter->where('id',$data->english_center_id)->pluck('name')->first()}}</td>
        <td class="white-space-preline-report">{{$event->where('id',$data->event_id)->pluck('name')->first()}}</td>
        <td class="white-space-preline-report">{{$data->identification}}</td>
        <td class="white-space-preline-report">{{!empty($genderType[$data->gender])?$genderType[$data->gender]:''}}</td>
        <td class="white-space-preline-report">{{convert_date_form_db($data->date_of_birth)}}</td>
        <td class="white-space-preline-report">{{$data->mail}}</td>
        <td class="white-space-preline-report">{{$data->phone_number}}</td>
        <td class="white-space-preline-report"><a href="{{$data->social_link}}">{{$data->social_link}}</a></td>
        <td class="white-space-preline-report">{{!empty($countries[$data->country_id])?$countries[$data->country_id]:''}}</td>
        <td class="white-space-preline-report">{{$data->city_name}}</td>
        <td class="white-space-preline-report">{{$data->school_name}}</td>
        <td class="white-space-preline-report">{{$studyTour->where('id',$data->study_tour)->pluck('name')->first()}}</td>
        <td class="white-space-preline-report">{{convert_date_form_db($data->departure_date)}}</td>
        <td class="white-space-preline-report">{{!empty($countries[$data->destination_to_study])?$countries[$data->destination_to_study]:''}}</td>
        <td class="white-space-preline-report">{{!empty($potentialityType[$data->potentiality])?$potentialityType[$data->potentiality]:''}}</td>
        <td class="white-space-preline-report">{{!empty($services[$data->potential_service])?$services[$data->potential_service]:''}}</td>
        <td class="white-space-preline-report">{{!empty($emailStatusType[$data->email_status])?$emailStatusType[$data->email_status]:''}}</td>
        <td class="white-space-preline-report">{{$data->note}}</td>
    </tr>
@endforeach
