<ul class="account-nav">
    <li><a href="{{route('user.index')}}" class="menu-link menu-link_us-s">Dashboard</a></li>
    <li><a href="{{route('user.orders')}}" class="menu-link menu-link_us-s">Orders</a></li>
    <li>
        <form method="POST" action="{{route('logout')}}" id = "logout-from">
            @csrf
            <a href="{{route('logout')}}" class="menu-link menu-link_us-s" onclick="event.preventDefault(); document.getElementById('logout-from').submit();">
                Logout</a>
        </form>
    </li>
</ul>