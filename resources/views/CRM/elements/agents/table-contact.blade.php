@foreach($data as $key=>$value)
    <tr id="data-agent-contact_{{$value['id']}}">
        <td>
            <a class="edit_contact" href="#!" data-id="{{$value['id']}}"><span class="far fa-edit"></span></a>
            <a class="del_contact" href="#!" data-id="{{$value['id']}}"
               data-url="{{route('agent.destroyContactAgent',['id'=>$value['id']])}}"><span
                    class="far fa-trash-alt "></span></a>
        </td>
        <th class="white-space-break-spaces">{{$value['id']}}</th>
        <td class="white-space-break-spaces c_name">{{$value['name']}}</td>
        <td class="white-space-break-spaces c_email">{{$value['email']}}</td>
        <td class="white-space-break-spaces c_phone">{{$value['phone']}}</td>
        <td class="white-space-break-spaces c_position">{{$value['position']}}</td>
        <td class="white-space-break-spaces c_birthday">{{$value['birthday']}}</td>
        <td class="white-space-break-spaces c_skype">{{$value['skype']}}</td>
        <td class="white-space-break-spaces c_facebook">{{$value['facebook']}}</td>
        <td class="white-space-break-spaces c_note">{{$value['note']}}</td>
        <td class="white-space-break-spaces c_is_receive_comm">{{$value['is_receive_comm']}}</td>
        <td class="white-space-break-spaces c_acc_name">{{$value['acc_name']}}</td>
        <td class="white-space-break-spaces c_bank">{{$value['bank']}}</td>
        <td class="white-space-break-spaces c_receiver_address">{{$value['receiver_address']}}</td>
        <td class="white-space-break-spaces c_currency">{{$value['currency']}}</td>
        <td class="white-space-break-spaces c_bank_address">{{$value['bank_address']}}</td>
        <td class="white-space-break-spaces c_swift_code">{{$value['swift_code']}}</td>

        <input type="hidden" name="contact_name[]" value="{{$value['name']}}">
        <input type="hidden" name="contact_position[]" value="{{$value['position']}}">
        <input type="hidden" name="contact_phone[]" value="{{$value['phone']}}">
        <input type="hidden" name="contact_birthday[]" value="{{$value['birthday']}}">
        <input type="hidden" name="contact_email[]" value="{{$value['email']}}">
        <input type="hidden" name="contact_skype[]" value="{{$value['skype']}}">
        <input type="hidden" name="contact_facebook[]" value="{{$value['facebook']}}">
        <input type="hidden" name="contact_note[]" value="{{$value['note']}}">

        <input type="hidden" name="contact_is_receive_comm[]" value="{{$value['is_receive_comm']}}">
        <input type="hidden" name="contact_acc_name[]" value="{{$value['acc_name']}}">
        <input type="hidden" name="contact_bank[]" value="{{$value['bank']}}">
        <input type="hidden" name="contact_receiver_address[]" value="{{$value['receiver_address']}}">
        <input type="hidden" name="contact_currency[]" value="{{$value['currency']}}">
        <input type="hidden" name="contact_bank_address[]" value="{{$value['bank_address']}}">
        <input type="hidden" name="contact_swift_code[]" value="{{$value['swift_code']}}">
        <input type="hidden" name="contact_is_counsellor[]" class="contact_is_counsellor"
               value="{{$value['is_counsellor']}}">
        <input type="hidden" name="contact_com_counsellor[]" class="contact_com_counsellor"
               value="{{$value['com_counsellor']}}">
    </tr>
@endforeach
