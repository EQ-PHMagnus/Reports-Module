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
            <li class="site-menu-item {{request()->route()->named('dashboard.finance.tax-computations') ?  'active' : ''}}">
                <a class="animsition-link" href="{{route('dashboard.finance.tax-computations')}}">
                    <i class="site-menu-icon fa-institution" aria-hidden="true"></i>
                    <span class="site-menu-title">Tax Computations</span>
                </a>
            </li>
            <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                    <i class="site-menu-icon fa-archive" aria-hidden="true"></i>
                    <span class="site-menu-title">Transaction History</span>
                    <span class="site-menu-arrow"></span>
                </a>
                <ul class="site-menu-sub">
                    <li class="site-menu-item {{request()->route()->named('dashboard.transactions.agent-transactions') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('dashboard.transactions.agent-transactions')}}">
                            <span class="site-menu-title">Agent/SuperAgent</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{request()->route()->named('dashboard.transactions.bettors-transactions') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('dashboard.transactions.bettors-transactions')}}">
                            <span class="site-menu-title">Bettors</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="site-menu-item {{request()->route()->named('bets.index') ?  'active' : ''}}">
                <a class="animsition-link" href="{{route('bets.index')}}">
                    <i class="site-menu-icon fa-newspaper-o" aria-hidden="true"></i>
                    <span class="site-menu-title">Bet History</span>
                </a>
            </li>

            <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                    <i class="site-menu-icon wb-file" aria-hidden="true"></i>
                    <span class="site-menu-title">Masterfile</span>
                    <span class="site-menu-arrow"></span>
                </a>
                <ul class="site-menu-sub">
                    <li class="site-menu-item {{request()->route()->named('agents.index') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('agents.index')}}">
                            <span class="site-menu-title">Agents</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{request()->route()->named('players.index') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('players.index')}}">
                            <span class="site-menu-title">Player</span>
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
                </ul>
            </li>
        </ul>
    </div>