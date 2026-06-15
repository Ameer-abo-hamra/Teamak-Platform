<?php

return [

    'company' => [

        [
            'icon' => 'fa-solid fa-chart-line',
            'label' => 'Dashboard',
            'route' => 'company.index',
        ],


        [
            'icon' => 'fa-solid fa-users',
            'label' => 'Employees',
            'route' => 'company.edit',
        ],
        [
            'icon' => 'fa-solid fa-lock',
            'label' => 'Roles',
            'route' => 'employees.index',
        ],
    ],

];
