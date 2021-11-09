<?php

return [
    'app-version'	  => '1.0.0',

    'menu' => [
      
        'agent-deposits' => [
            'title'                 =>  'Agent Deposits',
            'nav_title'             =>  'Agent Deposits',
            'content_title'         =>  'Agent Deposits List',
            'url'                   =>  'agent-deposits'
          

        ],
        'master-agent-deposits' => [
            'title'                 =>  'Master Agent Deposits',
            'nav_title'             =>  'Master Agent Deposits',
            'content_title'         =>  'Master Agent Deposits List',
            'url'                   =>  'master-agent-deposits'
          

        ],
        'agent-commissions' => [
            'super_agent'    =>  [
                'title'                 =>  'Master Agent Commisions',
                'nav_title'             =>  'Master Agent Commisions',
                'content_title'         =>  'Master Agent Commission List',
                'type'                  =>  'super_agent',
                'url'                   =>  'agent-commissions.super_agent'
            ],
            'agent'    =>  [
                'title'                 =>  'Agent Commisions',
                'nav_title'             =>  'Agent Commisions',
                'content_title'         =>  'Agent Commission List',
                'type'                  =>  'agent',
                'url'                   =>  'agent-commissions.agent'
            ],

        ],

        'players' => [
            'earnings'    =>  [
                'title'                 =>  'Player Earnings Reports',
                'nav_title'             =>  'Earnings ',
                'content_title'         =>  'Earnings',
                'type'                  =>  'earnings',
                'url'                   =>  'players.transactions'
            ],
            'cash_in'    =>  [
                'title'                 =>  'Player Cash-in Reports',
                'nav_title'             =>  'Cash in ',
                'content_title'         =>  'Cash in',
                'type'                  =>  'cash_in',
                'url'                   =>  'players.transactions'
            ],
            'cash_out'    =>  [
                'title'                 =>  'Players Cash-out Reports',
                'nav_title'             =>  'Cash out',
                'content_title'         =>  'Cash out',
                'type'                  =>  'cash_out',
                'url'                   =>  'players.transactions'
            ],
        ],

        // transactional
        'transactional-players' => [
            'earnings'    =>  [
                'title'           => 'Player Earnings Reports',
                'nav_title'       => 'Earnings ',
                'content_title'   => 'Earnings',
                'type'            => 'earnings',
                'url'             => 'transactional.players.transactions',
                'export_filename' => '_Players_Earning_Transactions_Reports'
            ],
            'cash_in'    =>  [
                'title'           => 'Player Cash-in Reports',
                'nav_title'       => 'Cash in ',
                'content_title'   => 'Cash in',
                'type'            => 'cash_in',
                'url'             => 'transactional.players.transactions',
                'export_filename' => '_Players_Cash_in_Transactions_Reports'
            ],
            'cash_out'    =>  [
                'title'           => 'Players Cash-out Reports',
                'nav_title'       => 'Cash out',
                'content_title'   => 'Cash out',
                'type'            => 'cash_out',
                'url'             => 'transactional.players.transactions',
                'export_filename' => '_Players_Cash_out_Transactions_Reports'
            ],
        ],

        'transactional-agent-commissions' => [
            'super_agent'    =>  [
                'title'           => 'Master Agent Commisions',
                'nav_title'       => 'Master Agent Commisions',
                'content_title'   => 'Master Agent Commission List',
                'type'            => 'super_agent',
                'url'             => 'transactional.agent-commissions',
                'export_filename' => '_Super_Agent_Commissions_Reports.xlsx'
            ],
            'agent'    =>  [
                'title'           => 'Agent Commisions',
                'nav_title'       => 'Agent Commisions',
                'content_title'   => 'Agent Commission List',
                'type'            => 'agent',
                'url'             => 'transactional.agent-commissions',
                'export_filename' => '_Agent_Commissions_Reports.xlsx'
            ],

        ],
    ]
];
