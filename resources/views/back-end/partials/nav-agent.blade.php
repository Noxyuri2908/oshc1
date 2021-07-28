<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            @include('back-end.partials.nav-header')
            <li class={{$flag == "reg"  ? "active" : ""}}>
                <a href="{{route('agent-reg.get')}}">
                    <i class="fa fa-bar-diamond"></i> 
                    <span class="nav-label">Service Register</span>
                </a>
            </li>
            <li class={{$flag == "profile"  ? "active" : ""}}>
                <a href="{{route('agent-profile.get')}}">
                    <i class="fa fa-bar-diamond"></i> 
                    <span class="nav-label">Account</span>
                </a>
            </li>
            <li class={{$flag == "commission"  ? "active" : ""}}>
                <a href="{{route('agent-commission.get')}}">
                    <i class="fa fa-bar-diamond"></i> 
                    <span class="nav-label">Commission</span>
                </a>
            </li>
            <li class="landing_link">
                <a target="_blank" href="#"><i class="fa fa-star"></i> <span class="nav-label">OSHC Global</span></a>
            </li>          
        </ul>
    </div>
</nav>