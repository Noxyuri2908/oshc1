<tr class="last-row" >
    <th></th>
    <th>
        <select class="form-control" name="type_id_filter" id="type_id_filter{{$type_tab}}">
            <option label=""></option>
            @if(!empty($checklistSetting))
                @foreach($checklistSetting as $keyCheckList=>$typeCheckList)
                    <option label="" value="{{$typeCheckList->id}}" {{!empty($checkListData) && $checkListData->type_id == $typeCheckList->id?'selected':''}}>{{$typeCheckList->name}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <div>
            <select class="form-control" name="website_id_filter" id="website_id_filter{{$type_tab}}">
            </select>
        </div>
    </th>
    @if($type_tab == 'checklist')
        <th>
            <div>
                <select class="form-control" name="category_id_filter" id="category_id_filter{{$type_tab}}">
                    <option label=""></option>

                </select>
            </div>
        </th>

    @endif
    <th>
        <select class="form-control" name="level_of_process" id="level_of_process">
            <option value=""></option>
            @foreach($lvprocessor as $lv => $value)
                <option value="{{$lv}}" {{(!empty($checkListData) && $checkListData->level_of_process == $lv)?'selected':''}}>{{$value}}</option>
            @endforeach
        </select>
    </th>
    <th>
        <div>
            <select class="form-control" name="result_id_filter" onmouseover="hoverResultIdFilter()" id="result_id_filter{{$type_tab}}" multiple>
                @if(!empty($results))
                    @foreach($results as $keyResult=>$value)
                        <option
                            value="{{$keyResult}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->country_id == $keyResult ?'selected':''}}>{{$value}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div class="d-flex">
            <input class="form-control" value="" name="processing_time_filter" id="start_processing_time_filter{{$type_tab}}"
                   type="text" required placeholder="Start Date">
            <input class="form-control" value="" name="processing_time_filter" id="end_processing_time_filter{{$type_tab}}"
                   type="text" required placeholder="Etart Date">
        </div>
    </th>
    <th>
        <input class="form-control" value="" name="problem_filter" id="problem_filter{{$type_tab}}" type="text"
               required>
    </th>
    <th>
        <input class="form-control" value="" name="detail_filter"
               id="detail_filter{{$type_tab}}" type="text" required>
    </th>
    <th>

    </th>
    <th>
        <div>
            <select class="form-control" name="proposer" id="proposer" onmouseover="hoverProposerIdFilter()">
                @if(!empty($admins))
                    <option value=""></option>
                    @foreach($admins as $keyAdmin=>$valueAdmin)
                        <option value="{{$keyAdmin}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->form_id == $keyAdmin ?'selected':''}}>{{$valueAdmin}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" onmouseover="hoverPersonIdFilter()" name="person_id_filter[]" id="person_id_filter{{$type_tab}}" multiple>
                @if(!empty($admins))
                    @foreach($admins as $keyAdmin=>$valueAdmin)
                        <option value="{{$keyAdmin}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->form_id == $keyAdmin ?'selected':''}}>{{$valueAdmin}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <input class="form-control" value="" name="date_of_suggestion_filter"
               id="date_of_suggestion_filter{{$type_tab}}" type="text" required>
    </th>


    @if($type_tab == 'checklist')
        <th>
            <select class="form-control" name="solution_text_filter" id="solution_text_filter{{$type_tab}}">
                <option label=""></option>
                @if(!empty($solution_it_checklist))
                    @foreach($solution_it_checklist as $keyCheckList=>$solution)
                        <option label="" value="{{$solution->id}}" {{!empty($checkListData) && $checkListData->solution_text == $solution->id?'selected':''}}>{{$solution->name}}</option>
                    @endforeach
                @endif
            </select>
        </th>
    @endif

    @if($type_tab == 'checklist')


        <th>
            <input class="form-control" value="" name="budget_filter" id="budget_filter{{$type_tab}}" type="text"
                   required>
        </th>
    @endif
    <th>
        <input class="form-control" value="" name="checklist_created_at_filter"
               id="checklist_created_at_filter{{$type_tab}}" type="text" required>
    </th>
    <th></th>
</tr>
<script>
    var activeHoverFilter = true;
    function hoverPersonIdFilter()
    {
        if (activeHoverFilter)
        {
            $('#person_id_filterchecklist').select2({
                closeOnSelect: false
            });
            activeHoverFilter = false;
        }

    }

    var activeHoverResultFilter = true;
    function hoverResultIdFilter()
    {
        if (activeHoverResultFilter)
        {
            $('#result_id_filterchecklist').select2({
                closeOnSelect: false
            });
            activeHoverResultFilter = false;
        }

    }


    var activeHoverFilterProposer = true;
    function hoverProposerIdFilter()
    {
        if (activeHoverFilterProposer)
        {
            $('#proposer').select2({
                closeOnSelect: false
            });
            activeHoverFilterProposer = false;
        }

    }
</script>
