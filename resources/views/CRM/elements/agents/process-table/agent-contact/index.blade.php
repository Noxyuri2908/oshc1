<div class="table-agent-contact table-div">
    <table class="">
        <thead class="">
            <tr class="first-row">
                <th class="width-80">Action</th>
                <th class="width-200">Agent Name</th>
                <th class="width-200">Name</th>
                <th class="width-200">Position</th>
                <th class="width-200">Phone</th>
                <th class="width-200">Birthday</th>
                <th class="width-200">Email</th>
                <th class="width-200">Skype</th>
                <th class="width-200">Facebook</th>
                <th class="width-200">Note</th>
                <th class="width-200">Receive commission</th>
                <th class="width-200">Acc Name</th>
                <th class="width-200">Bank</th>
                <th class="width-200">Currency</th>
                <th class="width-200">Bank address</th>
                <th class="width-200">Receiver address</th>
                <th class="width-200">Swift code</th>
            </tr>
            @include('CRM.pages.agent-contact.filter')
        </thead>
        <tbody id="agent-contact-table-tbody">

        </tbody>
    </table>
</div>
<div id="modal_agent_contact_form"></div>
@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>[
        'date_of_birth',
        'departure_date',
        'date_of_birth_filter',
        'departure_date_filter'
    ]])
    @include('CRM.partials.ajax-curd-load-more.get-data',[
    'nameAction'=>'agentContact',
    'valueNameField'=>[
        'user_id',
        'name',
        'position',
        'phone',
        'birthday',
        'email',
        'skype',
        'status',
        'facebook',
        'note',
        'is_receive_comm',
        'acc_name',
        'bank',
        'currency',
        'bank_address',
        'receiver_address',
        'swift_code'
    ],
    'urlGetData'=>route('agent.contact.getData'),
    'elementIdTableData'=>'agent-contact-table-tbody',
    'elementClassSubmitForm'=>'btn_submit_agent_contact_form',
    'elementIdEachData'=>'agent_contact_data',
    'elementIdModalForm'=>'modal_agent_contact_list',
    'elementIdCreateForm'=>'btn_add_agent_contact',
    'urlCreateForm'=>route('agent.contact.create'),
    'elementIdRenderModalForm'=>'modal_agent_contact_form',
    'elementClassEditForm'=>'edit_agent_contact',
    'elementClassDeleteForm'=>'delete_agent_contact',
    'table_element_class_scroll'=>'table-agent-contact',
    'agent_id'=>$agent_id
])
@endpush

