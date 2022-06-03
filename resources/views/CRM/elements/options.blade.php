<div class="option-header">
  @if(Auth::guard('admin')->check())
    <button class="add-news f-left btn trai"><a href="{{route('crm.agent.create')}}">
      <span class="fas fa-plus"></span>Add new</a>
    </button>
    <button data-route="#" class="action-del f-left btn trai delete-all">
      <span class="fas fa-trash-alt"></span> 
      <span>Delete</span>
    </button>
  <div class="xem-full trai">
    <span class="tit-f">Xem đầy đủ</span>
    <label class="switch">
      <input data-route="#" id="view_full" name="view_full" type="checkbox" 
      {{($type_view == 0) ? 'checked' : ''}}>
      <span class="slider round"></span>
    </label>
  </div>
  <div class="nav-item dropdown">
    <button class="f-left btn trai nav-link pr-0" id="navbarDropdownEmail" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="fas fa-mail-bulk"></span> <span>Send Email/SMS</span><span class="fas fa-sort-down"></span>
    </button>
    <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdownEmail">
      <div class="bg-white rounded-soft py-2">
        <a class="dropdown-item send-data" data-route="#" data-type =1 href="javascript:void(0)">Send Email</a>
        <a class="dropdown-item send-data" data-route="#" data-type =2 href="javascript:void(0)">Send Sms</a>
      </div>
    </div>
  </div>
  <div class="nav-item dropdown">
    <button class="f-left btn trai nav-link pr-0" id="navbarDropdownCol" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span>Attach Person in charge</span><span class="fas fa-sort-down"></span>
    </button>
    <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdownCol">
      <div class="bg-white rounded-soft py-2">
        @foreach($staffs as $staff)
        <a data-route="#" class="dropdown-item attach-user" data-user={{$staff->id}} href="javascript:void(0)" >{{$staff->name}}</a>
        @endforeach
      </div>
    </div>
  </div>
  @endif
  <form id="choncotForm" action="#" method="POST">
    @csrf
    <select id="_choncot" name="cotcanxem[]" multiple="multiple" class="f-left btn trai nav-link pr-0">
      @foreach($all_cot as $key=>$value)
      @if($value['type'] != 1)
      <option value="{{$key}}">{{$value['name']}}</option>
      @endif
      @endforeach
    </select>
  </form>
  <button type="submit" form="choncotForm" class="action-success f-left btn trai">    
    <span class="fas fa-check"></span>
    Apply
  </button>
</div>