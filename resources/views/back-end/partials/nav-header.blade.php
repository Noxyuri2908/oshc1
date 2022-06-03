<li class="nav-header">
    <div class="dropdown profile-element">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{Auth::user()->username}}</strong></span>
        <ul class="dropdown-menu animated fadeInRight m-t-xs">
            <li><a href="{{route('profile.get')}}">Profile</a></li>
            <li class="divider"></li>
            <li><a href="{{ route('logout') }}"  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    </form>Logout
                </a>
            </li>
        </ul>
    </div>
    <div class="logo-element">
        IN+
    </div>
</li>