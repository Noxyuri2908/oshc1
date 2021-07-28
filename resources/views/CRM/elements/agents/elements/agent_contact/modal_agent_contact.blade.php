<div class="modal fade" id="modalShowContactAgent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Contact</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="overflow-x:scroll ">
                <div class="w-100 table-div" style="overflow-x: scroll">
                    <table class="table" id="table_contact">
                        <thead class="thead-dark">
                            <tr class="first-row">
                                <th class="width-100" scope="col">#</th>
                                <th class="width-200" scope="col">Name</th>
                                <th class="width-200" scope="col">Position</th>
                                <th class="width-200" scope="col">Phone</th>
                                <th class="width-200" scope="col">Birthday</th>
                                <th class="width-200" scope="col">Email</th>
                                <th class="width-200" scope="col">Skype</th>
                                <th class="width-200" scope="col">Facebook</th>
                                <th class="width-500" scope="col">Note</th>
                                <th class="width-200">Receive commission</th>
                                <th class="width-200">Acc Name</th>
                                <th class="width-200">Bank</th>
                                <th class="width-200">Currency</th>
                                <th class="width-200">Bank address</th>
                                <th class="width-200">Receiver address</th>
                                <th class="width-200">Swift code</th>
                            </tr>
                        </thead>
                        <tbody id="table_contact_body">
                            @foreach($datas as $key=>$value)
                                <tr id="data-agent-contact_{{$value['id']}}">
                                    <th scope="row">{{$value['id']}}</th>
                                    <td class="text-overflow c_name">{{$value['name']}}</td>
                                    <td class="text-overflow c_position">{{$value['position']}}</td>
                                    <td class="text-overflow c_phone">{{$value['phone']}}</td>
                                    <td class="text-overflow c_birthday">{{$value['birthday']}}</td>
                                    <td class="text-overflow c_email">{{$value['email']}}</td>
                                    <td class="text-overflow c_skype">{{$value['skype']}}</td>
                                    <td class="text-overflow c_facebook">{{$value['facebook']}}</td>
                                    <td class="text-overflow c_note">{{$value['note']}}</td>
                                    <td class="text-overflow c_is_receive_comm">{{$value['is_receive_comm']}}</td>
                                    <td class="text-overflow c_acc_name">{{$value['acc_name']}}</td>
                                    <td class="text-overflow c_bank">{{$value['bank']}}</td>
                                    <td class="text-overflow c_currency">{{$value['currency']}}</td>
                                    <td class="text-overflow c_bank_address">{{$value['bank_address']}}</td>
                                    <td class="text-overflow c_receiver_address">{{$value['receiver_address']}}</td>
                                    <td class="text-overflow c_swift_code">{{$value['swift_code']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
