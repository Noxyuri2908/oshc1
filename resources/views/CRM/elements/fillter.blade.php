<div id="search-fast">
  <input class="w1" type="text" name="f_name" id="f_name" placeholder="Account name"
  value="{{isset($old_fillter) ? $old_fillter['f_name'] : old('f_name')}}">
  <input class="w1" type="text" name="f_email" id="f_email"  placeholder="Email address"
  value="{{isset($old_fillter) ? $$old_fillter['f_email'] : old('f_email')}}">
  <input class="w1" type="text" name="f_code" id="f_code"  placeholder="Agent code"
  value="{{isset($old_fillter) ? $old_fillter['f_code'] : old('f_code')}}">
  <input class="w1" type="text" name="f_phone" id="f_phone"  placeholder="Agent phone"
  value="{{isset($old_fillter) ? $old_fillter['f_phone'] : old('f_phone')}}">
  <input class="w1" type="text" name="f_country" id="f_country" placeholder="Agent country"
  value="{{isset($old_fillter) ? $old_fillter['f_country'] : old('f_country')}}">
  <select id="f_status" name="f_status" class="f-left btn trai nav-link pr-0">
    <option value="all" >Status business</option>
    @foreach($status as $key=>$value)
      <option value="{{$key}}" {{isset($old_fillter) ? ($old_fillter['f_status'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
    @endforeach
  </select>
  <input class="w1 date-pk" type="text" name="f_registered_date" id="f_registered_date" placeholder="Registered date"
  value="{{isset($old_fillter) ? $old_fillter['f_registered_date'] : old('f_registered_date')}}">
  <input class="w1" type="text" name="f_contact_person" id="f_contact_person" placeholder="Contact person"
  value="{{isset($old_fillter) ? $old_fillter['f_contact_person'] : old('f_contact_person')}}">
  <input class="w1" type="text" name="f_email_contact_person" id="f_email_contact_person" placeholder="Email contact person"
  value="{{isset($old_fillter) ? $old_fillter['f_email_contact_person'] : old('f_email_contact_person')}}">
  @include('CRM.elements.dropdown-type-agent')
</div>