<?php

return [
    'module'=>[
        [
            'title' => 'QL Nhóm thành viên',
            'icon' => 'fa fa-user',
            'name' => ['user'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm thành viên',
                    'route' =>  'user/catalogue/index',
                ],
                [
                    'title' => 'QL thành viên',
                    'route' => 'user/index',
                ],
            ]
        ],[
            'title' => 'QL Nhóm bài viết',
            'icon' => 'fa fa-file',
            'name' => ['post'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm bài viết',
                    'route' =>  'backend/user/catalogue/index',
                ],
                [
                    'title' => 'QL bài viết',
                    'route' => 'backend/user/index',
                ],
            ]
            ],[
                'title' => 'Cấu hình chung',
                'icon' => 'fa fa-file',
                'name' => ['language'], 
                'subModule' => [
                    [
                        'title' => 'QL Ngôn ngữ',
                        'route' =>  'language/index',
                    ],
                ]
            ]

    ],
 
];