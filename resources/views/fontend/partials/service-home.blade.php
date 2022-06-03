<div id="service-home" class="d-flex padding-group overflow-hidden justify-content-center">
	<div class="w-100">
		<div class="title-section">
			{{!empty($serviceHome) && !empty($serviceHome['title-1'])?$serviceHome['title-1']:''}}
        </div>

        {{-- <div class="buge">...</div> --}}
        @if(!empty($serviceHome) && !empty($serviceHome['service_home_main_content']))
		<div class="des-section">
            {{$serviceHome['service_home_main_content']}}
        </div>
        @endif
        @php
        $service_intro_home = !empty($serviceHome) && !empty($serviceHome['repeat']) && !empty($serviceHome['repeat']['service_home'])?$serviceHome['repeat']['service_home']:'';
        $sevice_intro_home = !empty($serviceHome) && !empty($serviceHome['repeat']) && !empty($serviceHome['repeat']['sub_service_home'])?$serviceHome['repeat']['sub_service_home']:'';
        @endphp
        <div class="row mx-5 border py-3 py-5 mb-5">
            @if(!empty($service_intro_home))
                @foreach ($service_intro_home as $key=>$sih)
                    <div class="col-md-3 col-xs-6 col-sm-6 col-6 px-5 py-5">
                        {{-- <a title="{{$sih['title']}}" class="text-decoration-none text-dark request-modal-service"
                        @if(!empty($sih['type']) && $sih['type'] == 1)
                        href="{{!empty($sih['link'])?$sih['link']:''}}"
                        @else
                        data-toggle="modal" data-target="#serviceHomeModal{{$key}}" href="#"
                        @endif
                        > --}}
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div style="">
                                <a style="width:100px;height:85px;display:inline-table" data-type='{{$sih['title']}}' title="{{$sih['title']}}" class="text-decoration-none text-dark request-modal-service"
                                   @if(!empty($sih['type']) && $sih['type'] == 1)
                                   href="{{!empty($sih['link'])?$sih['link']:''}}"
                                   @else
                                   data-toggle="modal" data-target="#serviceHomeModal{{$key}}" href="#"
                                    @endif
                                >
                                    <img class="w-100" src="{{!empty($sih['image'])?$sih['image']:''}}" alt="">
                                </a>
                            </div>
                            <div class="mt-4 font-size-16px text-center text-uppercase font-weight-bold">
                                <a data-type='{{$sih['title']}}' title="{{$sih['title']}}" class="text-decoration-none text-secondary request-modal-service"
                                   @if(!empty($sih['type']) && $sih['type'] == 1)
                                   href="{{!empty($sih['link'])?$sih['link']:''}}"
                                   @else
                                   data-toggle="modal" data-target="#serviceHomeModal{{$key}}" href="#"
                                    @endif
                                >
                                    {{(!empty($sih['title']))?$sih['title']:''}}
                                </a>
                            </div>
                        </div>
                        {{-- </a> --}}
                    </div>
                @endforeach
            @endif
        </div>
            @if(!empty($service_intro_home))
            @foreach ($service_intro_home as $key=>$sih)
                <div class="modal fade" id="serviceHomeModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-request-home" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="fas fa-times text-light"></i>
                                    </button>
                                </div>
                                <div class="w-100">
                                    <h5 class="modal-title text-light font-size-21px text-center">Please provide some information below for us to assist with your enquiry</h5>
                                </div>
                            </div>
                            <div class="modal-body w-100">
                                <form action="{{route("service_home.request")}}" id='request_form_home_service{{$key}}' method="post" enctype="multipart/form-data">
                                    <div class="row py-5 mx-0">
                                        {{ csrf_field() }}
                                        <div class="col-md-12 col-sm-12 col-xs-12 mb-5"><b class="font-size-14px">Your personal details:</b></div>

                                        <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
                                            <input type="text" placeholder="Full Name" class="form-control" name="full_name" required>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
                                            <input type="text" placeholder="Date of birth" autocomplete="off" class="form-control choose-date-form" name="birth_day_request" required>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
                                            <input type="text" placeholder="Your Email" class="form-control" name="email" required>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
                                            <select class="form-control" name="provider_id" id="" required>
                                                <option value="">OSHC provider</option>
                                                @foreach($provider as $provider_key=>$one)
                                                    <option value="{{$one}}">{{$one}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
                                            <input type="text" name="policy_no" placeholder="Policy No" class="form-control" required>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 mb-5"><b class="font-size-14px">Request: </b><span class="type-request-span font-size-14px font-weight-bold"></span></div>
                                        @if($key == 2)
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <label for="" class="font-size-14px">New start date:</label>
                                                    </div>
                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <input type="text" class="form-control choose-date-form"  autocomplete="off" name="new_start_date" required>
                                                    </div>
                                                    <div class="offset-md-4"></div>
                                                </div>
                                            </div>
                                        @elseif($key == 3)
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <label for=""  class="font-size-14px">Termination date:</label>
                                                    </div>
                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                        <input type="text" class="form-control choose-date-form"  autocomplete="off" name="termination_date" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 mt-3">
                                                <div class="row">
                                                    <div class="offset-md-4">

                                                    </div>
                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                        <select class="form-control" name="reason_termination" class="" id="form_policy_termination" required>
                                                            <option value="" ></option>
                                                            @foreach(\Config::get('myconfig.form_policy_termination') as $keyFormPolicyTermination=>$one)
                                                                <option value="{{$one}}">{{$one}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form_policy_termination_content">

                                                </div>
                                            </div>
                                        @elseif($key == 5 || $key== 4)
                                            @if($key == 5)
                                                <div class="col-md-12 col-sm-12 col-xs-12 mb-5"><b class="font-size-14px">Dependent to Remove</b></div>
                                            @endif
                                            <div class="box-repeat w-100 px-4">
                                                <div class="form-repeat row">
                                                    <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
                                                        <input placeholder="First Name" type="text" class="form-control" name="first_name[]" required>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
                                                        <input placeholder="Last Name" type="text" class="form-control" name="last_name[]" required>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
                                                        <input placeholder="Passport No" type="text" class="form-control" name="passport_no[]" required>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
                                                        <select class="form-control" name="relationship_dependent[]" id="" required>
                                                            <option value="">Relationship of dependent</option>
                                                            <option value="Child">Child</option>
                                                            <option value="Partner">Partner</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
                                                        <input placeholder="Date of birth" type="text"  autocomplete="off" class="choose-date-form form-control" name="birth_day[]" required>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="w-100 d-flex justify-content-end">
                                                <a href="#" class="btn btn-sm btn-success add_multi_grade mr-5">Add</a>
                                            </div> --}}
                                        @elseif($key == 6 || $key == 7)
                                        @else
                                            <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
                                                <input placeholder="First Name" type="text" class="form-control" name="first_name" required>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
                                                <input placeholder="Last Name" type="text" class="form-control" name="last_name" required>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
                                                <input placeholder="Passport No" type="text" class="form-control" name="passport_no" required>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
                                                <select class="form-control" name="country_id" id=""required>
                                                    <option value="">Country</option>
                                                    @foreach(\Config::get('country.list') as $keyCountry=>$one)
                                                        <option value="{{$one}}">{{$one}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
                                                <select class="form-control" name="gender_id" id="" required>
                                                    <option value="">Select</option>
                                                    @foreach(\Config::get('myconfig.gender') as $keyGender=>$one)
                                                        <option value="{{$one}}">{{$one}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12 mb-5">
                                                <input placeholder="Date of birth" type="text"  autocomplete="off" class="choose-date-form form-control" name="birth_day" required>
                                            </div>
                                        @endif
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label class="font-size-14px">Comment</label>
                                            <textarea class="form-control" name="note" cols="30" rows="10" required></textarea>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label class="font-size-14px">Supporting Document(s) - File Size Limit: 10MB, Maximum No. of Files: 3</label>
                                            <input name="service_home_file[]" type="file" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.ppt,.pptx,.odt,.avi,.ogg,.m4a,.mov,.mp3,.mp4,.mpg,.wav,.wmv" class="form-control-file" id="service_home_file{{$key}}" multiple>
                                            <span id="approvedFiles{{$key}}" class="form-text text-muted"></span>
                                        </div>
                                        <input type="hidden" name="type_request" class="type_request" value="">
                                    </div>
                                    <div class="w-100 d-flex justify-content-center align-items-center my-5">
                                        <button type="submit" id="button_submit{{$key}}" class="border-radius-20px btn btn-lg btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        @endif

          <div class="row mx-4 px-3 d-flex justify-content-between my-3">
              @if(!empty($sevice_intro_home))
                  @foreach ($sevice_intro_home as $sih)
                      <div class="col-lg-2 col-md-5 col-sm-12 col-xs-12 border py-0 px-3 ml-2 mb-2 text-dark" style="border-radius: 12px;background-color: #dee2e670;display:inline-table">
                          <a href="{{(!empty($sih['link']))?$sih['link']:''}}" class="text-decoration-none text-dark">
                              <div class="flex-row d-flex align-items-center py-2">
                                  <div class="d-flex" style="width: 85px;height:85px;display:inline-table" class="">
                                      <img style="object-fit: contain" class="w-100" src="{{!empty($sih['image'])?$sih['image']:''}}" alt="{{$sih['title']}}">
                                  </div>
                                  <div class="ml-4 font-weight-bold text-uppercase font-size-14px text-secondary">
                                      {{(!empty($sih['title']))?$sih['title']:''}}
                                  </div>
                              </div>
                          </a>
                      </div>
                  @endforeach
              @endif
        </div>
	</div>
</div> <!--  end service-home -->
@push('scripts')
    @if(!empty($service_intro_home))
        @foreach ($service_intro_home as $key=>$sih)
            <script>
                $("#service_home_file{{$key}}").on("change", function (e) {
                    var files = e.currentTarget.files; // puts all files into an array
                    var html ='';
                    var totalSize = 0;
                    if(files.length > 3){
                        html+='<p class =" alert alert-danger">Maximum number of file is 3</p>';
                        $('#button_submit{{$key}}').css('display','none');
                    }else{
                        $('#approvedFiles{{$key}}').html('');
                        $('#button_submit{{$key}}').css('display','block');
                    }
                    // call them as such; files[0].size will get you the file size of the 0th file
                    for (var x=0;x < files.length;x++) {
                        totalSize += files[x].size;
                    }
                    if(totalSize > 10000000){
                        html+='<p class =" alert alert-danger">Maximum size of file is 10MB</p>';
                        $('#button_submit{{$key}}').css('display','none');
                    }
                    else{
                        $('#approvedFiles{{$key}}').html('');
                        $('#button_submit{{$key}}').css('display','block');
                    }
                    $('#approvedFiles{{$key}}').html(html);
                });


            </script>
        @endforeach
    @endif
    <script>
        $(document).on('click','.add_multi_grade',function(e){
            e.preventDefault();
            var lastField = $(".box-repeat div:last");
            var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
            var html = '';
            html +='<div class="col-md-4 mb-5">';
            html +='<input placeholder="First Name" type="text" class="form-control" name="first_name[]" required>';
            html +='</div>';
            html +='<div class="col-md-4 mb-5">';
            html +='<input placeholder="Last Name" type="text" class="form-control" name="last_name[]" required>';
            html +='</div>';
            html +='<div class="col-md-4 mb-5">';
            html +='<input placeholder="Passport No" type="text" class="form-control" name="passport_no[]" required>';
            html +='</div>';
            html +='<div class="col-md-4 mb-5">';
            html +='<select class="form-control" name="relationship_dependent[]" id="" required>';
            html +='<option value="">Relationship of dependent</option>';
            html +='<option value="Child">Child</option>';
            html +='<option value="Partner">Partner</option>';
            html +='</select>';
            html +='</div>';
            html +=' <div class="col-md-4 mb-5">';
            html +='<input placeholder="Date of birth" type="text"  autocomplete="off" class="choose-date-form form-control" name="birth_day[]" required>';
            html +='</div>';
            var removeButton = $("<div class=\"col-md-1\"><input type=\"button\" class=\"remove\" value=\"-\" /></div>");
            var fieldWrapper = $("<div class='form-repeat row' id='field" + intId + "'/>");
            var endFieldWrapper ='</div>';
            removeButton.click(function () {
                $(this).parent().remove();
            });
            fieldWrapper.append($(html));
            fieldWrapper.append(removeButton);
            // console.log(fieldWrapper);
            // var outputHtml = fieldWrapper + html + endFieldWrapper;
            // console.log(outputHtml);
            fieldWrapper.appendTo(".box-repeat");
            // fieldWrapper.data("idx", intId);
            // var fName = $("<div class=\"col-md-11\"><input type=\"text\" class=\"form-control input-link-youtube\" value=\"\" name=\"link_youtube[]\" placeholder=\"Link youtube\" required></div>");
            // var removeButton = $("<div class=\"col-md-1\"><input type=\"button\" class=\"remove\" value=\"-\" /></div>");
            // removeButton.click(function () {
            //     $(this).parent().remove();
            // });
            // fieldWrapper.append(fName);
            // fieldWrapper.append(removeButton);
            // $("#link-youtube-group").append(fieldWrapper);
        })
        $('.request-modal-service').on('click',function(){
            $('.type_request').val($(this).data('type'));
            $('.type-request-span').text($(this).data('type'));
        })
        $('.title-sv').matchHeight();
        $(document).on('mouseover', '.choose-date-form', function () {
            let start_date_class = $(this).hasClass('flatpickr-input');
            if (!start_date_class) {
                $(this).flatpickr({
                    dateFormat: "d/m/Y",
                    allowInput:true
                    });
            }
        })

        $(document).on('change','#form_policy_termination',function(e){
            if($(this).val() == null || $(this).val() == ''){
                html ='';
            }else{
                html = '<p>Evidence Required</p>';
                html += '<p>OSHC Refund & Cancellation Form; and</p>';
                if($(this).val() == 'You paid for cover but did not come to Australia'){
                    html += '<p>Letter from Department of Immigration indicating decline of student visa; or</p>';
                    html += '<p>Letter from Institution confirming you will no longer be coming to Australia to study.</p>';
                }else if ($(this).val() == 'Your student visa was not extended, was cancelled or a renewal/extension was refused'){
                    html += '<p>Letter from Department of Immigration indicating non renewal, extension or cancellation; or</p>';
                    html += '<p>Copy of student visa.</p>';
                }else if ($(this).val() == 'You need to leave Australia before the end of your studies and approved preiod of stay') {
                    html += '<p>Certificate of completion from Institution; or</p>';
                    html += '<p>Flight departure details (ticket, boarding pass or exit stamp and identification page from passport).</p>';
                    html += '<p>Itinerary not accepted and variations of the above not accepted.</p>';
                }else if($(this).val() == 'You have been granted permanent residence in Australia'){
                    html += '<p>Copy of permanent residency visa label from your passport or immigration letter indicating the date when permanent residency will commence; or</p>';
                    html += '<p>Medicare eligibility statement; or</p>';
                    html += '<p>Letter from Department of Immigration (DIAC).</p>';
                }else if($(this).val() == 'You are not living in Australia for 3 months or more'){
                    html += '<p>If you’re going to another country for 3 or more months you’ll have to show us your boarding pass to and from your destination.</p>';
                    html += '<p>You won’t be able to claim for any services while your policy is suspended; or</p>';
                    html += '<p>Exit Stamps and identification pages from Passport.</p>';
                }else if($(this).val() == 'You can provide proof of OSHC with another organisation'){
                    html += '<p>Confirmation of Health Cover Certificate from another OSHC provider (showing: commencement and expiry dates, listed beneficiaries and type of policy).</p>';
                }else if($(this).val() == 'Change the scale of policy i.e from single to family'){
                    html += '<p>Letter from the Department of Immigration from a family policy to a single policy indicating family member(s) leaving Australia; or</p>';
                    html += '<p>Flight departure details (Listed as above).</p>';
                }else if($(this).val() == 'You have been granted a new visa type'){
                    html += '<p>Letter from the Department of Immigration confirming new working/visitor visa type.</p>';
                }else if($(this).val() == 'Change to your policy visa start and/or end date'){
                    html += '<p>Letter from the Department of Immigration confirming new visa dates; or</p>';
                    html += '<p>Letter from Institute confirming new course dates.</p>';
                }
            }
            $('.form_policy_termination_content').html(html);
        })
        @if(\Session::has('success'))
            Swal.fire({
                title:'Your request has been successfully submitted.',
                html:'We will process it soon and respond via email. Thank you!',
                width: 800,
            }
        )
        @endif
    </script>
@endpush
