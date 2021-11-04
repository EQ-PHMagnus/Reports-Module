<div class="site-menubar">
        <ul class="site-menu">
            @can('view reports')
            <li class="site-menu-item {{request()->is('raven/total-bets') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('raven/total-bets')}}">
                    <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i><span class="site-menu-title">Total Bets</span>
                </a>
            </li>
            <li class="site-menu-item {{request()->is('raven/total-fights') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('raven/total-fights')}}">
                    <i class="site-menu-icon wb-flag" aria-hidden="true"></i><span class="site-menu-title">Total Fights</span>
                </a>
            </li>

            <li class="site-menu-item {{request()->route()->named('dashboard.finance.tax-computations') ?  'active' : ''}}">
                <a class="animsition-link" href="{{route('dashboard.finance.tax-computations')}}">
                    <i class="site-menu-icon fa-institution" aria-hidden="true"></i>
                    <span class="site-menu-title">Tax Computations</span>
                </a>
            </li>

            <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                    <i class="site-menu-icon wb-users" aria-hidden="true"></i>
                    <span class="site-menu-title">Players Transactions</span>
                    <span class="site-menu-arrow"></span>
                </a>
                <ul class="site-menu-sub">
                @forelse(config('constants.menu.players') as $key => $val)
                    <li class="site-menu-item ">
                        <a class="animsition-link" href="{{route($val['url'])}}">
                            <span class="site-menu-title">{{$val['nav_title']}}</span>
                        </a>
                    </li>
                @empty
                @endforelse
                </ul>

            </li>
            @endcan
           
            
         
            @can('manage super agent cash ins')
            <li class="site-menu-item {{request()->is('raven/master-agent-deposits') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('raven/master-agent-deposits')}}">
                    <i class="site-menu-icon wb-user-circle" aria-hidden="true"></i><span class="site-menu-title">Master Agent Deposits</span>
                </a>
            </li>
            <li class="site-menu-item {{request()->is('raven/agent-deposits') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('raven/agent-deposits')}}">
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
            <li class="site-menu-item {{request()->is('raven/roles-and-permissions') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('raven/roles-and-permissions')}}">
                    <i class="site-menu-icon wb-user" aria-hidden="true"></i><span class="site-menu-title">Roles and permissions</span>
                </a>
            </li>

            <li class="site-menu-item {{request()->is('raven/import-data') ?  'active' : ''}}">
                <a class="animsition-link" href="{{url('raven/import-data')}}">
                    <i class="site-menu-icon wb-upload" aria-hidden="true"></i><span class="site-menu-title">Import Data</span>
                </a>
            </li>
            
            @endcan

           
           
        </ul>
    </div>