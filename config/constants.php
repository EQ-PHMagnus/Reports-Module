<?php

return [
    'app-version'	  => '1.0.0',

    'menu' => [
        'bets' => [
            'total-count-bets'    =>  [
                'title'                 =>  'Total Bets Count ',
                'nav_title'             =>  'Total Bets Count',
                'content_title'         =>  'Total Count of Bets',
                'type'                  =>  'count',
                'url'                   =>  'total-count-bets'
            ],
            'total-amount-bets'    =>  [
                'title'                 =>  'Total Bets Amount ',
                'nav_title'             =>  'Total Bets Amount',
                'content_title'         =>  'Total Amount of Bets',
                'type'                  =>  'sum',
                'url'                   =>  'total-amount-bets'
            ],
            'total-count-bets-arena'    =>  [
                'title'                 =>  'Total Bets Count per Arena ',
                'nav_title'             =>  'Total Bets Count per Arena',
                'content_title'         =>  'Total Count of Bets per Arena',
                'type'                  =>  'sum',
                'name'                  =>  'arena',
                'url'                   =>  'total-count-bets-arena'
            ],
            'total-amount-bets-arena'    =>  [
                'title'                 =>  'Total Bets Amount per Arena ',
                'nav_title'             =>  'Total Bets Amount per Arena',
                'content_title'         =>  'Total Amount of Bets per Arena',
                'type'                  =>  'sum',
                'name'                  =>  'arena',
                'url'                   =>  'total-amount-bets-arena'
            ],
        ],

        'fights' => [
                'total-count-fights'    =>  [
                    'title'                 =>  'Total Fights Count ',
                    'nav_title'             =>  'Total Fights Count',
                    'content_title'         =>  'Total Count of Fights',
                    'type'                  =>  'count',
                    'url'                       =>  'total-count-fights'
                ],
                'total-count-fights-arena'    =>  [
                    'title'                 =>  'Total Fights Count per Arena ',
                    'nav_title'             =>  'Total Fights Count per Arena ',
                    'content_title'         =>  'Total Count of Fights per Arena',
                    'type'                  =>  'count',
                    'name'                  =>  'arena',
                    'url'                       =>  'total-count-fights-arena'
                ],

        ],
        'agent-deposits' => [
            'pending'    =>  [
                'title'                 =>  'Agent Deposits Pending',
                'nav_title'            =>  'Pending',
                'content_title'         =>  'Pending List',
                'type'                  =>  'pending',
                'url'                       =>  'agent-deposits.pending'
            ],
            'processed'    =>  [
                'title'                 =>  'Agent Deposits Processed',
                'nav_title'             =>  'Processed',
                'content_title'         =>  'Processed List',
                'type'                  =>  'processed',
                'url'                       =>  'agent-deposits.processed'
            ],

    ]
    ]
];
