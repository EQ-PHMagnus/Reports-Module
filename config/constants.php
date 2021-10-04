<?php

return [
    'app-version'	  => '1.0.0',

    'menu' => [
        'bets' => [
            'total-count-bets'    =>  [
                'title'                 =>  'Total Bets Count ',
                'content_title'         =>  'Total Count of Bets',
                'type'                  =>  'count',
                'route'                 =>  'total-count-bets'
            ],
            'total-amount-bets'    =>  [
                'title'                 =>  'Total Bets Amount ',
                'content_title'         =>  'Total Amount of Bets',
                'type'                  =>  'sum',
                'route'                 =>  'total-amount-bets'
            ],
            'total-count-bets-arena'    =>  [
                'title'                 =>  'Total Bets Count per Arena ',
                'content_title'         =>  'Total Count of Bets per Arena',
                'type'                  =>  'sum',
                'name'                  =>  'arena',
                'route'                 =>  'total-count-bets-arena'
            ],
            'total-amount-bets-arena'    =>  [
                'title'                 =>  'Total Bets Amount per Arena ',
                'content_title'         =>  'Total Amount of Bets per Arena',
                'type'                  =>  'sum',
                'name'                  =>  'arena',
                'route'                 =>  'total-amount-bets-arena'
            ],
        ],

        'fights' => [
                'total-count-fights'    =>  [
                    'title'                 =>  'Total Fights Count ',
                    'content_title'         =>  'Total Count of Fights',
                    'type'                  =>  'count',
                    'route'                 =>  'total-count-fights'
                ],
                'total-count-fights-arena'    =>  [
                    'title'                 =>  'Total Fights Count per Arena ',
                    'content_title'         =>  'Total Count of Fights per Arena',
                    'type'                  =>  'sum',
                    'name'                  =>  'arena',
                    'route'                 =>  'total-count-fights-arena'
                ],
               
        ]
    ]
];
