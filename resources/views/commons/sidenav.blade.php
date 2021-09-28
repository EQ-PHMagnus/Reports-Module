<div class="site-menubar">
        <ul class="site-menu">
            <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                    <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                    <span class="site-menu-title">Bet Reports</span>
                    <span class="site-menu-arrow"></span>
                </a>
                <ul class="site-menu-sub">
                    <li class="site-menu-item {{request()->route()->named('dashboard.finance.total-bets') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('dashboard.finance.total-bets')}}">
                            <span class="site-menu-title">Total Bets</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{request()->route()->named('dashboard.finance.total-bets-arena') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('dashboard.finance.total-bets-arena')}}">
                            <span class="site-menu-title">Total Bets Arena</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                    <i class="site-menu-icon wb-file" aria-hidden="true"></i>
                    <span class="site-menu-title">Masterfile</span>
                    <span class="site-menu-arrow"></span>
                </a>
                <ul class="site-menu-sub">
                    <li class="site-menu-item {{request()->route()->named('users.index') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('users.index')}}">
                            <span class="site-menu-title">Affiliates</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{request()->route()->named('arenas.index') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('arenas.index')}}">
                            <span class="site-menu-title">Arenas</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{request()->route()->named('fights.index') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('fights.index')}}">
                            <span class="site-menu-title">Fights</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{request()->route()->named('bets.index') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('bets.index')}}">
                            <span class="site-menu-title">Bet History</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>