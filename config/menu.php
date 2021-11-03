<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Menus
    |--------------------------------------------------------------------------
    |
    |
    */

    'prefix' => 'raven',
    'guard'  => 'admin',
    'menus'  => [
        [
            'route_name'   => 'bets/*',
            'display_name' => 'Bets Report',
            'icon'         => 'wb-dashboard',
            'prefix'       => 'raven/bets/',
            'submenus'     => [
                [
                    'route_name'   => 'total-count-bets',
                    'display_name' => 'Total Count Bets',
                    'show'         => true,
                    'permissions'  => ['view reports'],
                ],
                [
                    'route_name'   => 'total-amount-bets',
                    'display_name' => 'Total Amount Bets',
                    'show'         => true,
                    'permissions'  => ['view reports']
                ],
                [
                    'route_name'   => 'total-count-bets-arena',
                    'display_name' => 'Total Bets Count per Arena',
                    'show'         => true,
                    'permissions'  => ['view reports']
                ],
                [
                    'route_name'   => 'total-amount-bets-arena',
                    'display_name' => 'Total Bets Amount per Arena',
                    'show'         => true,
                    'permissions'  => ['view reports']
                ],
            ],
            'show'         => true,
            'permissions'  => ['view reports']
        ],
        [
            'route_name'   => 'fights/*',
            'display_name' => 'Fights Report',
            'icon'         => 'wb-flag',
            'prefix'       => 'raven/fights/',
            'submenus'     => [
                [
                    'route_name'   => 'total-count-fights',
                    'display_name' => 'Total Count Fights',
                    'show'         => true,
                    'permissions'  => ['view reports'],
                ],
                [
                    'route_name'   => 'total-count-fights-arena',
                    'display_name' => 'Total Fights Count per Arena',
                    'show'         => true,
                    'permissions'  => ['view reports']
                ],
            ],
            'show'         => true,
            'permissions'  => ['view reports']
        ],


    ]
     
];
