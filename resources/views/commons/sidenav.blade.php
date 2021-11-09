<div class="site-menubar sidenav">
        <ul class="site-menu">
            @can('view reports')
            <li class="site-menu-category">Reports</li>
            <li class="site-menu-item {{request()->is('total-bets') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('total-bets')}}">
                    <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i><span class="site-menu-title">Total Bets</span>
                </a>
            </li>
            <li class="site-menu-item {{request()->is('total-fights') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('total-fights')}}">
                    <i class="site-menu-icon wb-flag" aria-hidden="true"></i><span class="site-menu-title">Total Fights</span>
                </a>
            </li>

            <!-- TAX COMPUTAION REPORTS -->
            <li class="site-menu-item {{request()->route()->named('tax.gross-receipts') 
                || request()->route()->named('tax.total-GBR') 
                || request()->route()->named('tax.gross-commission') 
                || request()->route()->named('tax.net-commission')
                || request()->route()->named('tax.final-taxes-winnings')
                ?  'active' : ''}} has-sub">
                <a href="javascript:void(0)">
                    <i class="site-menu-icon wb-users" aria-hidden="true"></i>
                    <span class="site-menu-title">Tax Computations</span>
                    <span class="site-menu-arrow"></span>
                </a>
                <ul class="site-menu-sub">
                    <li class="site-menu-item {{request()->route()->named('tax.gross-receipts') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('tax.gross-receipts')}}">
                            <i class="site-menu-icon fa-institution" aria-hidden="true"></i>
                            <span class="site-menu-title">Gross Receipts from Bets</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{request()->route()->named('tax.total-GBR') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('tax.total-GBR')}}">
                            <i class="site-menu-icon fa-institution" aria-hidden="true"></i>
                            <span class="site-menu-title">Total GBR Tax Reports</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{request()->route()->named('tax.gross-commission') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('tax.gross-commission')}}">
                            <i class="site-menu-icon fa-institution" aria-hidden="true"></i>
                            <span class="site-menu-title">Gross Commission Tax</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{request()->route()->named('tax.net-commission') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('tax.net-commission')}}">
                            <i class="site-menu-icon fa-institution" aria-hidden="true"></i>
                            <span class="site-menu-title">Net Commissions</span>
                        </a>
                    </li>
                    <li class="site-menu-item {{request()->route()->named('tax.final-taxes-winnings') ?  'active' : ''}}">
                        <a class="animsition-link" href="{{route('tax.final-taxes-winnings')}}">
                            <i class="site-menu-icon fa-institution" aria-hidden="true"></i>
                            <span class="site-menu-title">Final Taxes on Winnings</span>
                        </a>
                    </li>
                </ul>

            </li>
            <!-- END TAX COMPUTAION REPORTS -->

            <li class="site-menu-item {{request()->is('players/players_earnings') || request()->is('players/players_cash_in') || request()->is('players/players_cash_out') ?  'active' : ''}} has-sub">
                <a href="javascript:void(0)">
                    <i class="site-menu-icon wb-users" aria-hidden="true"></i>
                    <span class="site-menu-title">Players Transactions</span>
                    <span class="site-menu-arrow"></span>
                </a>
                <ul class="site-menu-sub">
                @forelse(config('constants.menu.players') as $key => $val)
                    <li class="site-menu-item {{request()->is(route($val['url'])) ? 'active' : '' }}" >
                        <a class="animsition-link" href="{{route($val['url'], ['type' => $val['type']])}}">
                            <span class="site-menu-title">{{$val['nav_title']}}</span>
                        </a>
                    </li>
                @empty
                @endforelse
                </ul>

            </li>
            @endcan
           
            @can('manage super agent cash ins')
            <li class="site-menu-item {{request()->is('master-agent-deposits') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('master-agent-deposits')}}">
                    <i class="site-menu-icon wb-user-circle" aria-hidden="true"></i><span class="site-menu-title">Master Agent Deposits</span>
                </a>
            </li>
            <li class="site-menu-item {{request()->is('agent-deposits') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('agent-deposits')}}">
                    <i class="site-menu-icon wb-user-circle" aria-hidden="true"></i><span class="site-menu-title">Agent Deposits</span>
                </a>
            </li>
          
            
               
            @forelse(config('constants.menu.agent-commissions') as $key => $val)
                <li class="site-menu-item {{request()->route()->named($val['url']) ?  'active' : ''}}">
                    <a class="animsition-link" href="{{route($val['url'])}}">
                        <i class="site-menu-icon fa-user" aria-hidden="true"></i>
                        <span class="site-menu-title">{{$val['nav_title']}}</span>
                    </a>
                </li>
            @empty
            @endforelse
            
            @endcan

            @can('manage users')
            <li class="site-menu-item {{request()->route()->named('users.index') ?  'active' : ''}}">
                <a class="animsition-link" href="{{route('users.index')}}">
                <i class="site-menu-icon wb-user" aria-hidden="true"></i><span class="site-menu-title">User Management</span>
                </a>
            </li>
           
            @endcan
            @can('manage roles and permissions')
            <li class="site-menu-item {{request()->is('roles-and-permissions') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('roles-and-permissions')}}">
                    <i class="site-menu-icon wb-user" aria-hidden="true"></i><span class="site-menu-title">Roles and permissions</span>
                </a>
            </li>

            <li class="site-menu-item {{request()->is('import-data') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('import-data')}}">
                    <i class="site-menu-icon wb-upload" aria-hidden="true"></i><span class="site-menu-title">Import Data</span>
                </a>
            </li>
            @endcan

            <!-- TRANSACTIONAL -->
            @can('view reports')
            <li class="site-menu-category">TRANSACTIONAL</li>
            <li class="site-menu-item {{request()->is('total-bets') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('total-bets')}}">
                    <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i><span class="site-menu-title">Bets</span>
                </a>
            </li>
            <li class="site-menu-item {{request()->is('total-fights') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('total-fights')}}">
                    <i class="site-menu-icon wb-flag" aria-hidden="true"></i><span class="site-menu-title">Fights</span>
                </a>
            </li>

            <!-- END TAX COMPUTAION REPORTS -->

            <li class="site-menu-item {{request()->is('players/players_earnings') || request()->is('players/players_cash_in') || request()->is('players/players_cash_out') ?  'active' : ''}} has-sub">
                <a href="javascript:void(0)">
                    <i class="site-menu-icon wb-users" aria-hidden="true"></i>
                    <span class="site-menu-title">Players Transactions</span>
                    <span class="site-menu-arrow"></span>
                </a>
                <ul class="site-menu-sub">
                @forelse(config('constants.menu.transactional-players') as $key => $val)
                    <li class="site-menu-item {{request()->is(route($val['url'])) ? 'active' : '' }}" >
                        <a class="animsition-link" href="{{route($val['url'], ['type' => $val['type']])}}">
                            <span class="site-menu-title">{{$val['nav_title']}}</span>
                        </a>
                    </li>
                @empty
                @endforelse
                </ul>

            </li>
            @endcan
           
            @can('manage super agent cash ins')
            <li class="site-menu-item {{request()->is('master-agent-deposits') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('master-agent-deposits')}}">
                    <i class="site-menu-icon wb-user-circle" aria-hidden="true"></i><span class="site-menu-title">Master Agent Deposits</span>
                </a>
            </li>
            <li class="site-menu-item {{request()->is('agent-deposits') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('agent-deposits')}}">
                    <i class="site-menu-icon wb-user-circle" aria-hidden="true"></i><span class="site-menu-title">Agent Deposits</span>
                </a>
            </li>
          
            
               
            @forelse(config('constants.menu.agent-commissions') as $key => $val)
                <li class="site-menu-item {{request()->route()->named($val['url']) ?  'active' : ''}}">
                    <a class="animsition-link" href="{{route($val['url'])}}">
                        <i class="site-menu-icon fa-user" aria-hidden="true"></i>
                        <span class="site-menu-title">{{$val['nav_title']}}</span>
                    </a>
                </li>
            @empty
            @endforelse
            
            @endcan

           
            @can('manage roles and permissions')
            <li class="site-menu-item {{request()->is('roles-and-permissions') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('roles-and-permissions')}}">
                    <i class="site-menu-icon wb-user" aria-hidden="true"></i><span class="site-menu-title">Roles and permissions</span>
                </a>
            </li>

            <li class="site-menu-item {{request()->is('import-data') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('import-data')}}">
                    <i class="site-menu-icon wb-upload" aria-hidden="true"></i><span class="site-menu-title">Import Data</span>
                </a>
            </li>
            @endcan
        </ul>
    </div>