<ul class="main-menu">
    @foreach($items as $menu_item)
        <li class="menu-item">
            <a @if(Request::path() == "/") href="{{ $menu_item->url }}" @else href="/{{ $menu_item->url }}" @endif >{{ $menu_item->title }}</a>
        </li>
    @endforeach
</ul>