<?php

return [
    'app-version'	  => '1.0.0',

    'menu' => [
        'bets' => [
            'total-count-bets'    =>  [
                'title'                 =>  'Total Bets Count ',
                'content_title'         =>  'Total Count of Bets',
                'type'                  =>  'count',
                'url'                 =>  url('raven/bets/total-count-bets')
            ],
            'total-amount-bets'    =>  [
                'title'                 =>  'Total Bets Amount ',
                'content_title'         =>  'Total Amount of Bets',
                'type'                  =>  'sum',
                'url'                 =>  url('raven/bets/total-amount-bets')
            ],
            'total-count-bets-arena'    =>  [
                'title'                 =>  'Total Bets Count per Arena ',
                'content_title'         =>  'Total Count of Bets per Arena',
                'type'                  =>  'sum',
                'name'                  =>  'arena',
                'url'                 =>  url('raven/bets/total-count-bets-arena')
            ],
            'total-amount-bets-arena'    =>  [
                'title'                 =>  'Total Bets Amount per Arena ',
                'content_title'         =>  'Total Amount of Bets per Arena',
                'type'                  =>  'sum',
                'name'                  =>  'arena',
                'url'                   =>  url('raven/bets/total-amount-bets-arena')
            ],
        ],

        'fights' => [
                'total-count-fights'    =>  [
                    'title'                 =>  'Total Fights Count ',
                    'content_title'         =>  'Total Count of Fights',
                    'type'                  =>  'count',
                    'url'                   =>  url('raven/fights/total-count-fights')
                ],
                'total-count-fights-arena'    =>  [
                    'title'                 =>  'Total Fights Count per Arena ',
                    'content_title'         =>  'Total Count of Fights per Arena',
                    'type'                  =>  'count',
                    'name'                  =>  'arena',
                    'url'                   =>  url('raven/fights/total-count-fights-arena')
                ],
               
        ],
        'agent-deposits' => [
            'pending'    =>  [
                'title'                 =>  'Agent Deposits Pending',
                'content_title'         =>  'Pending List',
                'type'                  =>  'pending',
                'url'                   =>  url('raven/agent-deposits/pending')
            ],
            'processed'    =>  [
                'title'                 =>  'Agent Deposits Processed',
                'content_title'         =>  'Processed List',
                'type'                  =>  'processed',
                'url'                   =>  url('raven/agent-deposits/processed')
            ],
           
    ]
    ]
];
