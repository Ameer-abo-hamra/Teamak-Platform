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
            'route' => 'company.employee.index',
        ],
        [
            'icon' => 'fa-solid fa-building-flag',
            'label' => 'Projects',
            'route' => 'company.projects.index',
        ],
        [
            'icon' => 'fa-solid fa-clipboard-list',
            'label' => 'Tasks',
            'route' => 'company.tasks',
        ],
    ],

];
