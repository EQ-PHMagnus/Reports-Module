<div class="site-menubar">
    <ul class="site-menu">
        @forelse(config('menu.menus') as $menu)
      
            @if($menu['show'] && can($menu['permissions']))
                <li class="site-menu-item {{ !empty($menu['submenus']) ? 'has-sub' : '' }} {{ request()->is('raven/'.$menu['route_name']) ?  "active" : '' }}">
                    @if(!empty($menu['submenus']))
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon {{ $menu['icon'] }}" aria-hidden="true"></i>
                            <span class="site-menu-title text-lg">{{ $menu['display_name'] }}</span>
                            <span class="site-menu-arrow"></span>
                        </a>

                        <ul class="site-menu-sub">
                            @foreach($menu['submenus'] as $submenu)
                                @if($submenu['show'] && can($submenu['permissions'], true))
                                   
                                        <li class="site-menu-item {{ request()->is($menu['prefix'].$submenu['route_name']) ? 'active' : '' }}">
                                            <a class="animsition-link" href="{{$submenu['route_name']}}">
                                                <span class="site-menu-title text-lg">{{ $submenu['display_name'] }}</span>
                                            </a>
                                        </li>
                                
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <a class="animsition-link" href="{{$menu['route_name']}}">
                            <i class="site-menu-icon {{ $menu['icon'] }}" aria-hidden="true"></i>
                            <span class="site-menu-title text-lg">{{ $menu['display_name'] }}</span>
                        </a>
                    @endif
                </li>
            @endif
        @empty
        @endforelse
    </ul>
</div>

