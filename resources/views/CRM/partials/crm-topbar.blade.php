<div class="top-bar navbar-top navbar-expand">
  <div class="col-md-12">
    <div class="cms-title">
      <button class="add-news f-left btn trai" style="margin-top: -3px;"><a href="{{route('crm.home')}}">
        <span class=" fas fa-home"></span> CMS Home</a>
      </button>
      CRM SYSTEM - OSHC
    </div>
    <div class="cms-top-bar-center">
      <div class="nav-item dropdown">
        <a class="nav-link pr-0" id="navbarDropdownUser" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          @if(Auth::check())
          <span class="topbar-c-t">Hello ! {{Auth::guard('admin')->user()->email}}</span>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdownUser">
          <div class="bg-white rounded-soft py-2">
            <a class="dropdown-item" href="{{ route('admin.logout') }}"  >Logout
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="cms-top-bar-right">
      <span>NOTIFICATION:</span>
      <ul class="navbar-nav align-items-center ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link unread-indicator" id="navbarDropdownNotification" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="count-not">0</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-card" aria-labelledby="navbarDropdownNotification">
            <div class="card card-notification shadow-none" style="max-width: 20rem">
              <div class="card-header">
                <div class="row justify-content-between align-items-center">
                  <div class="col-auto">
                    <h6 class="card-header-title mb-0">Notification</h6>
                  </div>
                </div>
              </div>
              <div class="list-group list-group-flush font-weight-normal fs--1">
                <div class="list-group-title">Birthday of agent</div>
                <div class="list-group-item"></div>
              </div>
              <!-- <div class="card-footer text-center border-top-0"><a class="card-link d-block" href="pages/notifications.html">View all</a></div> -->
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>

</div>