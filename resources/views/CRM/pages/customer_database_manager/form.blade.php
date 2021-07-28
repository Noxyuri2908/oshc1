<div class="modal fade user-information" id="modal_customer_list" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{!empty($customerData)?'Update':'Add new'}}
                    customer
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content-information">
                    <div class="row">
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Type of customer:</label>
                                <select class="form-control" name="type_of_customer_id" id="type_of_customer_id">
                                    <option label=""></option>
                                    @if(!empty($typeOfCustomer))
                                        @foreach($typeOfCustomer as $keyTypeOfCustomer=>$valueOfCustomer)
                                            <option
                                                value="{{$valueOfCustomer->id}}" {{!empty($customerData) && $customerData->type_of_customer_id == $valueOfCustomer->id ?'selected':''}}>{{$valueOfCustomer->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="type_of_customer_id_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Full name:</label>
                                <input type="text" class="form-control" value="{{!empty($customerData)?$customerData->full_name:''}}" id="full_name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Resource:</label>
                                <select class="form-control" name="source_id" id="source_id">
                                    <option label=""></option>
                                    @if(!empty($resource))
                                        @foreach($resource as $keyResource=>$valueResource)
                                            <option
                                                value="{{$valueResource->id}}" {{!empty($customerData) && $customerData->source_id == $valueResource->id ?'selected':''}}>{{$valueResource->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="source_id_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Agent:</label>
                                <select class="form-control" name="agent_id" id="agent_id">
                                    <option label=""></option>
                                    @if(!empty($agents))
                                        @foreach($agents as $keyAgent=>$valueAgent)
                                            <option
                                                value="{{$keyAgent}}" {{!empty($customerData) && $customerData->agent_id == $keyAgent ?'selected':''}}>{{$valueAgent}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="agent_id_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">English center:</label>
                                <select class="form-control" name="english_center_id" id="english_center_id">
                                    <option label=""></option>
                                    @if(!empty($englishCenter))
                                        @foreach($englishCenter as $keyEnglishCenter=>$valueEnglishCenter)
                                            <option
                                                value="{{$valueEnglishCenter->id}}" {{!empty($customerData) && $customerData->english_center_id == $valueEnglishCenter->id ?'selected':''}}>{{$valueEnglishCenter->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="english_center_id_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Event:</label>
                                <select class="form-control" name="event_id" id="event_id">
                                    <option label=""></option>
                                    @if(!empty($event))
                                        @foreach($event as $keyEvent=>$valueEvent)
                                            <option
                                                value="{{$valueEvent->id}}" {{!empty($customerData) && $customerData->event_id == $valueEvent->id ?'selected':''}}>{{$valueEvent->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="english_center_id_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Identification :</label>
                                <input type="text" id="identification" class="form-control" value="{{!empty($customerData)?$customerData->identification:''}}">
                                <small id="identification_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Gender :</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option label=""></option>
                                    @if(!empty($genderType))
                                        @foreach($genderType as $keyGenderType=>$typeGenderType)
                                            <option
                                                value="{{$keyGenderType}}" {{!empty($customerData) && $customerData->gender == $keyGenderType ?'selected':''}}>{{$typeGenderType}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="gender_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Date of birth:</label>
                                <input type="text" class="form-control" value="{{!empty($customerData)?convert_date_form_db($customerData->date_of_birth):''}}" id="date_of_birth" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Email:</label>
                                <input type="email" class="form-control" value="{{!empty($customerData)?$customerData->mail:''}}" id="mail" autocomplete="off">
                                <small id="mail_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Phone number:</label>
                                <input type="number" class="form-control" value="{{!empty($customerData)?$customerData->phone_number:''}}" id="phone_number" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Social link:</label>
                                <input type="text" class="form-control" value="{{!empty($customerData)?$customerData->social_link:''}}" id="social_link" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Country :</label>
                                <select class="form-control" name="country_id" id="country_id">
                                    <option label=""></option>
                                    @if(!empty($countries))
                                        @foreach($countries as $keyCountry=>$valueCountry)
                                            <option
                                                value="{{$keyCountry}}" {{!empty($customerData) && $customerData->country_id == $keyCountry ?'selected':''}}>{{$valueCountry}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="country_id_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">City:</label>
                                <input type="text" class="form-control" value="{{!empty($customerData)?$customerData->city_name:''}}" id="city_name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">School:</label>
                                <input type="text" class="form-control" value="{{!empty($customerData)?$customerData->school_name:''}}" id="school_name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Study tour:</label>
                                <select class="form-control" name="study_tour" id="study_tour">
                                    <option label=""></option>
                                    @if(!empty($studyTour))
                                        @foreach($studyTour as $keyStudyTour=>$valueStudyTour)
                                            <option
                                                value="{{$valueStudyTour->id}}" {{!empty($customerData) && $customerData->study_tour == $valueStudyTour->id ?'selected':''}}>{{$valueStudyTour->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="study_tour_div_alert" class="form-text text-danger"></small>                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Departure date:</label>
                                <input type="text" class="form-control" value="{{!empty($customerData)?convert_date_form_db($customerData->departure_date):''}}" id="departure_date" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Destination to study:</label>
                                <select class="form-control" name="destination_to_study" id="destination_to_study">
                                    <option label=""></option>
                                    @if(!empty($countries))
                                        @foreach($countries as $keyCountryStudy=>$valueCountry)
                                            <option
                                                value="{{$keyCountryStudy}}" {{!empty($customerData) && $customerData->destination_to_study == $keyCountryStudy ?'selected':''}}>{{$valueCountry}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="destination_to_study_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Potentiality:</label>
                                <select class="form-control" name="potentiality" id="potentiality">
                                    <option label=""></option>
                                    @if(!empty($potentialityType))
                                        @foreach($potentialityType as $keyPotentialityType=>$valuePotentialityType)
                                            <option
                                                value="{{$keyPotentialityType}}" {{!empty($customerData) && $customerData->potentiality == $keyPotentialityType ?'selected':''}}>{{$valuePotentialityType}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="potentiality_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Potential service:</label>
                                <select class="form-control" name="potential_service" id="potential_service">
                                    <option label=""></option>
                                    @if(!empty($services))
                                        @foreach($services as $keyService=>$valueService)
                                            <option
                                                value="{{$keyService}}" {{!empty($customerData) && $customerData->potential_service == $keyService ?'selected':''}}>{{$valueService}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="potential_service_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Email status:</label>
                                <select class="form-control" name="email_status" id="email_status">
                                    <option label=""></option>
                                    @if(!empty($emailStatusType))
                                        @foreach($emailStatusType as $keyEmailStatus=>$typeEmailStatus)
                                            <option
                                                value="{{$keyEmailStatus}}" {{!empty($customerData) && $customerData->email_status == $keyEmailStatus ?'selected':''}}>{{$typeEmailStatus}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="email_status_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-12 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Note:</label>
                                <textarea name="" id="note" cols="20" class="form-control" rows="10">{{!empty($customerData)?$customerData->note:''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success mr-1 mb-1 btn_submit_customer_form" type="submit"
                        is-click="false"
                        data-url="{{!empty($customerData)?route('customer_database_manager.update',['id'=>$customerData->id]):route('customer_database_manager.store')}}">{{!empty($customerData)?'Update':'Submit'}}</button>
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
