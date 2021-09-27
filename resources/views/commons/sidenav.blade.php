<div class="site-menubar">
        <ul class="site-menu">
            <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                    <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                    <span class="site-menu-title">Finance Reports</span>
                    <span class="site-menu-arrow"></span>
                </a>
                <ul class="site-menu-sub">
                    <li class="site-menu-item {{request()->route()->named('dashboard.finance.total-bets') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('dashboard.finance.total-bets')}}">
                            <span class="site-menu-title">Total Bets</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{request()->route()->named('dashboard.finance.total-fights') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('dashboard.finance.total-fights')}}">
                            <span class="site-menu-title">Total Fights</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{request()->route()->named('dashboard.finance.magnus-earnings') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('dashboard.finance.magnus-earnings')}}">
                            <span class="site-menu-title">Magnus Earnings</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{request()->route()->named('dashboard.finance.agent-accounts') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('dashboard.finance.agent-accounts')}}">
                            <span class="site-menu-title">Agent/SuperAgent Accounts</span>
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
                </ul>
            </li>
        </ul>
    </div>