<nav class="navbar navbar-vertical navbar-expand-lg navbar-light navbar-glass">
  <a class="navbar-brand text-left" href="#">
    <div class="d-flex align-items-center text-primary py-3">
      <div class="d-inline-flex flex-center"><span class="text-sans-serif">CRM OSHC</span></div>
    </div>
  </a>
  <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
    <ul class="navbar-nav flex-column">
      <!-- Bảng tin -->
      <li class="nav-item {{$flag == 'dashboard' ? 'active' : ''}}">
        <a class="nav-link" href="{{route('crm.dashboard')}}">
          <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-store-alt"></span></span><span>DASHBOARD</span>
          </div>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('post.index')}}" target="_blank">
          <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fab fa-firefox"></span></span><span>CMS OSHC</span>
          </div>
        </a>
      </li>
    </ul>
    <hr class="border-300 my-2" />
    <ul class="navbar-nav flex-column">
      <li class="nav-item {{$flag == 'agent' ? 'active' : ''}}">
        <a class="nav-link" href="{{route('crm.agent')}}">
          <div class="d-flex align-items-center"><span class="nav-link-icon">
            <span class="fas fa-users"></span></span><span>AGENT</span>
          </div>
        </a>
      </li>
      </li>
      <li class="nav-item {{$flag == 'staff' ? 'active' : ''}}">
        <a class="nav-link" href="{{route('staff.index')}}" target="_blank">
          <div class="d-flex align-items-center"><span class="nav-link-icon">
            <span class="fas fa-user-cog"></span></span><span>STAFF</span>
          </div>
        </a>
      </li>
    </ul>
    <hr class="border-300 my-2" />
    <ul class="navbar-nav flex-column">
      <li class="nav-item {{$flag == 'service' ? 'active' : ''}}">
        <a class="nav-link" href="{{route('service.index')}}" target="_blank">
          <div class="d-flex align-items-center"><span class="nav-link-icon">
            <span class="fas fa-shipping-fast"></span></span><span>SERVICE</span>
          </div>
        </a>
      </li>
      </li>
      <li class="nav-item {{$flag == 'apply' ? 'active' : ''}}">
        <a class="nav-link" href="{{route('crm.apply')}}">
          <div class="d-flex align-items-center"><span class="nav-link-icon">
            <span class="fas fa-cart-plus"></span></span><span>APPLIES</span>
          </div>
        </a>
      </li>
      <li class="nav-item {{$flag == 'promotion' ? 'active' : ''}}">
        <a class="nav-link" href="{{route('promotion.index')}}">
          <div class="d-flex align-items-center"><span class="nav-link-icon">
            <span class="far fa-snowflake"></span></span><span>PROMOTION</span>
          </div>
        </a>
      </li>
      <li class="nav-item {{$flag == 'support' ? 'active' : ''}}">
        <a class="nav-link" href="#">
          <div class="d-flex align-items-center"><span class="nav-link-icon">
            <span class="fas fa-phone-square"></span></span><span>SUPPORT</span>
          </div>
        </a>
      </li>
    </ul>
    <hr class="border-300 my-2" />
    <ul class="navbar-nav flex-column">
      <li class="nav-item {{$flag == 'report' ? 'active' : ''}}">
        <a class="nav-link" href="#">
          <div class="d-flex align-items-center"><span class="nav-link-icon">
            <span class="fas fa-chart-pie"></span></span><span>REPORT</span>
          </div>
        </a>
      </li>
      </li>
      <li class="nav-item {{$flag == 'notify' ? 'active' : ''}}">
        <a class="nav-link" href="#">
          <div class="d-flex align-items-center"><span class="nav-link-icon">
            <span class="fas fa-bell"></span></span><span>NOTIFICATION</span>
          </div>
        </a>
      </li>
    </ul>
<a class="btn btn-primary btn-sm m-3" href="{{ route('admin.logout') }}">Logout</a>
</div>
</nav>