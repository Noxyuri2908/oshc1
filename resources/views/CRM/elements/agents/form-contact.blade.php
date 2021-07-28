<div class="card mb-3">
    <div class="card-header">
        <div class="chevron-down-up">
            <h5 class="mb-0">Contact persons</h5>
            <p class="click-down" data-id="contact"><span class="fas fa-chevron-down"></span></p>
        </div>
    </div>
    <div class="card-body bg-light" data-id="com">
        @if(empty($is_show))
            <a class="mb-4 d-block d-flex align-items-center add_contact"
               @if(!empty($obj))
               data-user_id="{{$obj->id}}" data-url="{{route('crm.createContact',['id'=>$obj->id])}}"
               @endif
               href="#!"
               aria-expanded="false"
               aria-controls="experience-form">
                <span class="circle-dashed">
                    <span class="fas fa-plus"></span>
                </span>
                <span class="ml-3">Add new contact person</span>
            </a>
        @endif
        <div class="w-100 table-div" style="overflow-x: scroll">
            <table class="table" id="table_contact">
                <thead class="thead-dark">
                    <tr class="first-row">
                        <th class="width-100">Action</th>
                        <th class="width-100">#</th>
                        <th class="width-100">Name</th>
                        <th class="width-100">Email</th>
                        <th class="width-100">Phone</th>
                        <th class="width-100">Position</th>
                        <th class="width-100">Birthday</th>
                        <th class="width-100">Skype</th>
                        <th class="width-100">Facebook</th>
                        <th class="width-500">Note</th>
                        <th class="width-100">Receive commission</th>
                        <th class="width-100">Acc Name</th>
                        <th class="width-100">Bank</th>
                        <th class="width-100">Bank account</th>
                        <th class="width-100">Currency</th>
                        <th class="width-100">Bank address</th>
                        <th class="width-100">Swift code</th>
                    </tr>
                </thead>
                <tbody id="table_contact_body">
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).on('change', '#is_receive_comm', function (e) {
            e.preventDefault()
            if (this.checked == true) {
                $('.info_bank').css('display', 'block')
            } else if (this.checked == false) {
                $('.info_bank').css('display', 'none')
            }
        })
    </script>
@endpush
