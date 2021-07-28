<div class="nav-item dropdown">
  <button class="f-left btn trai nav-link pr-0" id="navbarDropdownCol" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="fas fa-users"></span><span>{{$type_agent}}</span><span class="fas fa-sort-down"></span>
  </button>
  <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdownCol">
    <div class="bg-white rounded-soft py-2">
      <a class="dropdown-item" href="#"
        {{$status_agent == '1' ? "style=display:none" : ''}}>
        Active Agent
      </a>
      <a class="dropdown-item" href="#"
        {{$status_agent == '0' ? "style=display:none" : ''}}>
        De-active Agent
      </a>
  </div>
</div>