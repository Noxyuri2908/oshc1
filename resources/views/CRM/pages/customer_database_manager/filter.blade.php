<tr class="last-row">
    <th></th>
    <th>
        <select class="form-control" name="type_of_customer_id" id="type_of_customer_id_filter">
            <option label=""></option>
            @if(!empty($typeOfCustomer))
                @foreach($typeOfCustomer as $keyTypeOfCustomer=>$valueOfCustomer)
                    <option
                        value="{{$valueOfCustomer->id}}" {{!empty($customerData) && $customerData->type_of_customer_id == $valueOfCustomer->id ?'selected':''}}>{{$valueOfCustomer->name}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <input type="text" class="form-control" value="{{!empty($customerData)?$customerData->full_name:''}}"
               id="full_name_filter" autocomplete="off">
    </th>
    <th>
        <select class="form-control" name="source_id" id="source_id_filter">
            <option label=""></option>
            @if(!empty($resource))
                @foreach($resource as $keyResource=>$valueResource)
                    <option
                        value="{{$valueResource->id}}" {{!empty($customerData) && $customerData->source_id == $valueResource->id ?'selected':''}}>{{$valueResource->name}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <select class="form-control" name="agent_id" id="agent_id_filter">
            <option label=""></option>
            @if(!empty($agents))
                @foreach($agents as $keyAgent=>$valueAgent)
                    <option
                        value="{{$keyAgent}}" {{!empty($customerData) && $customerData->agent_id == $keyAgent ?'selected':''}}>{{$valueAgent}}</option>
                @endforeach
            @endif
        </select></th>
    <th>
        <select class="form-control" name="english_center_id" id="english_center_id_filter">
            <option label=""></option>
            @if(!empty($englishCenter))
                @foreach($englishCenter as $keyEnglishCenter=>$valueEnglishCenter)
                    <option
                        value="{{$valueEnglishCenter->id}}" {{!empty($customerData) && $customerData->english_center_id == $valueEnglishCenter->id ?'selected':''}}>{{$valueEnglishCenter->name}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <select class="form-control" name="event_id" id="event_id_filter">
            <option label=""></option>
            @if(!empty($event))
                @foreach($event as $keyEvent=>$valueEvent)
                    <option
                        value="{{$valueEvent->id}}" {{!empty($customerData) && $customerData->event_id == $valueEvent->id ?'selected':''}}>{{$valueEvent->name}}</option>
                @endforeach
            @endif
        </select>    </th>
    <th>
        <input type="text" id="identification_filter" class="form-control" value="{{!empty($customerData)?$customerData->identification:''}}">
    </th>

    <th>
        <select class="form-control" name="gender" id="gender_filter">
            <option label=""></option>
            @if(!empty($genderType))
                @foreach($genderType as $keyGenderType=>$typeGenderType)
                    <option
                        value="{{$keyGenderType}}" {{!empty($customerData) && $customerData->gender == $keyGenderType ?'selected':''}}>{{$typeGenderType}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <input type="text" class="form-control" value="{{!empty($customerData)?convert_date_form_db($customerData->date_of_birth):''}}" id="date_of_birth_filter" autocomplete="off">
    </th>
    <th>
        <input type="email" class="form-control" value="{{!empty($customerData)?$customerData->mail:''}}" id="mail_filter" autocomplete="off">
    </th>
    <th>
        <input type="number" class="form-control" value="{{!empty($customerData)?$customerData->phone_number:''}}" id="phone_number_filter" autocomplete="off">
    </th>
    <th>
        <input type="text" class="form-control" value="{{!empty($customerData)?$customerData->social_link:''}}" id="social_link_filter" autocomplete="off">
    </th>
    <th>
        <select class="form-control" name="country_id" id="country_id_filter">
            <option label=""></option>
            @if(!empty($countries))
                @foreach($countries as $keyCountry=>$valueCountry)
                    <option
                        value="{{$keyCountry}}" {{!empty($customerData) && $customerData->country_id == $keyCountry ?'selected':''}}>{{$valueCountry}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <input type="text" class="form-control" value="{{!empty($customerData)?$customerData->city_name:''}}" id="city_name_filter" autocomplete="off">
    </th>
    <th>
        <input type="text" class="form-control" value="{{!empty($customerData)?$customerData->school_name:''}}" id="school_name_filter" autocomplete="off">
    </th>
    <th>
        <select class="form-control" name="study_tour" id="study_tour_filter">
            <option label=""></option>
            @if(!empty($studyTour))
                @foreach($studyTour as $keyStudyTour=>$valueStudyTour)
                    <option
                        value="{{$valueStudyTour->id}}" {{!empty($customerData) && $customerData->study_tour == $valueStudyTour->id ?'selected':''}}>{{$valueStudyTour->name}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <input type="text" class="form-control" value="{{!empty($customerData)?convert_date_form_db($customerData->departure_date):''}}" id="departure_date_filter" autocomplete="off">
    </th>
    <th>
        <select class="form-control" name="destination_to_study" id="destination_to_study_filter">
            <option label=""></option>
            @if(!empty($countries))
                @foreach($countries as $keyCountryStudy=>$valueCountry)
                    <option
                        value="{{$keyCountryStudy}}" {{!empty($customerData) && $customerData->destination_to_study == $keyCountryStudy ?'selected':''}}>{{$valueCountry}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <select class="form-control" name="potentiality" id="potentiality_filter">
            <option label=""></option>
            @if(!empty($potentialityType))
                @foreach($potentialityType as $keyPotentialityType=>$valuePotentialityType)
                    <option
                        value="{{$keyPotentialityType}}" {{!empty($customerData) && $customerData->potentiality == $keyPotentialityType ?'selected':''}}>{{$valuePotentialityType}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <select class="form-control" name="potential_service" id="potential_service_filter">
            <option label=""></option>
            @if(!empty($services))
                @foreach($services as $keyService=>$valueService)
                    <option
                        value="{{$keyService}}" {{!empty($customerData) && $customerData->potential_service == $keyService ?'selected':''}}>{{$valueService}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <select class="form-control" name="email_status" id="email_status_filter">
            <option label=""></option>
            @if(!empty($emailStatusType))
                @foreach($emailStatusType as $keyEmailStatus=>$typeEmailStatus)
                    <option
                        value="{{$keyEmailStatus}}" {{!empty($customerData) && $customerData->email_status == $keyEmailStatus ?'selected':''}}>{{$typeEmailStatus}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <input type="text" class="form-control" value="{{!empty($customerData)?$customerData->note:''}}" id="note_filter" autocomplete="off">
    </th>
</tr>
