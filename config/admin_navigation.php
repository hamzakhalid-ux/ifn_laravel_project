<?php

return [
    'dashboard' => [
        'nav_level' => 1, // tree level
        'privs' => [], // Priv Ids
        'title' => 'Dashboard',
        'icon' => 'fa fa-tachometer',
        'url' =>  '/admin/dashboard/' ,
    ],
    'users' => [
        'nav_level' => 2, // tree level
        'privs' => [3,4,5,6], // Priv Ids
        'icon' => 'fa fa-users',
        'links' => [
            'admin/users/all-users' => [
                'title' => 'All Users',
                'icon' => 'fa fa-user-circle',
                'url' => 'admin/users/all-users',
                'privs' => [6], // Priv Ids
            ],
            'admin/users/add-user' => [
                'title' => 'New User',
                'icon' => 'fa fa-user-plus',
                'url' => 'admin/users/add-user',
                'privs' => [3], // Priv Ids
            ]
        ]
    ],
    'Tags' => [
        'nav_level' => 2,
        'privs' => [7,8,9,10], // Priv Ids,
        'icon' => 'fa fa-map-marker',
        'links' => [
            'admin/add-tag' => [
                'title' => 'Add Tag',
                'icon' => 'fa fa-check',
                'url' => 'admin/add-tag',
                'privs' => [7], // Priv Ids
            ],
            'admin/list-tag' => [
                'title' => 'List Tag',
                'icon' => 'fa fa-trash',
                'url' => 'admin/list-tag',
                'privs' => [10], // Priv Ids
            ]
        ]
    ],
    'categories' => [
        'nav_level' => 2,
        'privs' => [11,12,13,14], // Priv Ids,
        'icon' => 'fa fa-tag',
        'links' => [
            'admin/add-category' => [
                'title' => 'Add Category',
                'icon' => 'fa fa-tag',
                'url' => 'admin/add-category',
                'privs' => [11], // Priv Ids
            ],
            'admin/list-categories' => [
                'title' => 'List Category',
                'icon' => 'fa fa-ban',
                'url' => 'admin/list-categories',
                'privs' => [14], // Priv Ids
            ],

        ]
    ],
    'Posts' => [
        'nav_level' => 2, // tree level
        'privs' => [15,16,17,18], // Priv Ids,
        'icon' => 'fa fa-tag',
        'links' => [
            'admin/post/add-post' => [
                'title' => 'Add Post',
                'icon' => 'fa fa-tag',
                'url' => 'admin/post/add-post',
                'privs' => [15], // Priv Ids
            ],
            'admin/post/list-post' => [
                'title' => 'List Post',
                'icon' => 'fa fa-ban',
                'url' => 'admin/post/list-post',
                'privs' => [18], // Priv Ids
            ],
        ]
    ],
    'pages' => [
        'nav_level' => 2, // tree level
        'privs' => [19,20,21,22], // Priv Ids,
        'shop_user' => true,
        'icon' => 'fa fa-product-hunt',
        'links' => [
            'admin/page/add-page' => [
                'title' => 'Add Page',
                'shop_user' => true,
                'icon' => 'fa fa-check',
                'url' => 'admin/page/add-page',
                'privs' => [19], // Priv Ids
            ],
            'admin/page/list-pages' => [
                'title' => 'List Pages',
                'shop_user' => true,
                'icon' => 'fa fa-trash',
                'url' => 'admin/page/list-pages',
                'privs' => [22], // Priv Ids
            ]
        ]
    ],
    'Media' => [
        'nav_level' => 2, // tree level
        'privs' => [23,24,31], // Priv Ids,
        'shop_user' => true,
        'icon' => 'fa fa-camera-retro',
        'links' => [
            'admin/media/library' => [
                'title' => 'Library',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/media/library',
                'privs' => [31], // Priv Ids
            ],
        ]
    ],
    'Menu' => [
        'nav_level' => 2, // tree level
        'privs' => [25,26,27,28], // Priv Ids,
        'title' => 'Menu',
        'shop_user' => true,
        'icon' => 'fa fa-product-hunt',
        'links' => [
            'admin/menu/add-menu' => [
                'title' => 'Add Menu',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/menu/add-menu',
                'privs' => [25], // Priv Ids
            ],
            'admin/menu/list-menu' => [
                'title' => 'List Menu',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/menu/list-menu',
                'privs' => [28], // Priv Ids
            ],
        ]
    ],
    'Domain' => [
        'nav_level' => 2, // tree level
        'privs' => [1], // Priv Ids,
        'title' => 'Domain',
        'shop_user' => true,
        'icon' => 'fa fa-product-hunt',
        'links' => [
            'admin/domain/list-domain' => [
                'title' => 'List domain',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/domain/list-domain',
                'privs' => [1], // Priv Ids
            ],
        ]
    ],
    'Directory' => [
        'nav_level' => 2, // tree level
        'privs' => [32,33,34,35], // Priv Ids,
        'title' => 'Company',
        'shop_user' => true,
        'icon' => 'fa fa-product-hunt',
        'links' => [
            'admin/company/add-company' => [
                'title' => 'Add Directory',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/company/add-company',
                'privs' => [32], // Priv Ids
            ],
            'admin/company/list-companies' => [
                'title' => 'List Directories',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/company/list-companies',
                'privs' => [35], // Priv Ids
            ],
        ]
    ],
    'Funds' => [
        'nav_level' => 2, // tree level
        'privs' => [36,37,38,39], // Priv Ids,
        'title' => 'Funds',
        'shop_user' => true,
        'icon' => 'fa fa-product-hunt',
        'links' => [
            'admin/fund/add-fund' => [
                'title' => 'Add Fund',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/company/add-fund',
                'privs' => [36], // Priv Ids
            ],
            'admin/fund/list-funds' => [
                'title' => 'List Funds',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/company/list-funds',
                'privs' => [39], // Priv Ids
            ],
        ]
    ],
    'Forms' => [
        'nav_level' => 2, // tree level
        'privs' => [40,41,42,43], // Priv Ids,
        'title' => 'Forms',
        'shop_user' => true,
        'icon' => 'fa fa-product-hunt',
        'links' => [
            'admin/form/add-form' => [
                'title' => 'Add Form',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/form/add-form',
                'privs' => [40], // Priv Ids
            ],
            'admin/form/list-forms' => [
                'title' => 'List Form',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/form/list-forms',
                'privs' => [43], // Priv Ids
            ],
        ]
    ],
    'Setting' => [
        'nav_level' => 2, // tree level
        'privs' => [44,45,46,47,56,57,58,59], // Priv Ids,
        'title' => 'Setting',
        'shop_user' => true,
        'icon' => 'fa fa-product-hunt',
        'links' => [
            'admin/setting/add-setting' => [
                'title' => 'Home setting',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/setting/add-setting',
                'privs' => [44], // Priv Ids
            ],
            'admin/setting/filter-setting' => [
                'title' => 'Filter Setting',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/setting/filter-setting',
                'privs' => [56], // Priv Ids
            ],
            'admin/setting/list-filter-setting' => [
                'title' => 'Filter Setting Listing',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/setting/list-filter-setting',
                'privs' => [59], // Priv Ids
            ],
        ]
    ],
    'Packages' => [
        'nav_level' => 2, // tree level
        'privs' => [48,49,50,51], // Priv Ids,
        'title' => 'Packages',
        'shop_user' => true,
        'icon' => 'fa fa-product-hunt',
        'links' => [
            'admin/package/add-package' => [
                'title' => 'Add package',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/package/add-package',
                'privs' => [48], // Priv Ids
            ],
            'admin/package/list-packages' => [
                'title' => 'List Packages',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/package/list-packages',
                'privs' => [51], // Priv Ids
            ],
        ]
    ],
    'Custom Deals' => [
        'nav_level' => 2, // tree level
        'privs' => [52,53,54,55], // Priv Ids,
        'title' => 'Custom Deals',
        'shop_user' => true,
        'icon' => 'fa fa-product-hunt',
        'links' => [
            'admin/deal/add-deal' => [
                'title' => 'Add Custom Deals',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/deal/add-deal',
                'privs' => [52], // Priv Ids
            ],
            'admin/deal/list-deals' => [
                'title' => 'List Custom Deals',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/deal/list-deals',
                'privs' => [55], // Priv Ids
            ],
        ]
    ],

    'Locations' => [
        'nav_level' => 2, // tree level
        'privs' => [60,61,62,63], // Priv Ids,
        'title' => 'Locations',
        'shop_user' => true,
        'icon' => 'fa fa-product-hunt',
        'links' => [
            'admin/location/add-location' => [
                'title' => 'Add Location',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/location/add-location',
                'privs' => [60], // Priv Ids
            ],
            'admin/location/list-locations' => [
                'title' => 'List Locations',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/location/list-locations',
                'privs' => [62], // Priv Ids
            ],
        ]
    ],

    'Subscriber' => [
        'nav_level' => 2, // tree level
        'privs' => [64,69,70,71], // Priv Ids,
        'title' => 'Subscriber',
        'shop_user' => true,
        'icon' => 'fa fa-product-hunt',
        'links' => [
            'admin/subscriber/list-subscriber' => [
                'title' => 'List Subscriber',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/subscriber/list-subscriber',
                'privs' => [64], // Priv Ids
            ],
            'admin/subscriber/add-subscriber' => [
                'title' => 'Add Subscriber',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/subscriber/add-subscriber',
                'privs' => [67], // Priv Ids
            ],
        ]
    ],

    'Ads' => [
        'nav_level' => 2, // tree level
        'privs' => [65,66,67,68], // Priv Ids,
        'title' => 'Ads',
        'shop_user' => true,
        'icon' => 'fa fa-product-hunt',
        'links' => [
            'admin/ads/add-ads' => [
                'title' => 'Add Ad',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/ads/add-ads',
                'privs' => [65], // Priv Ids
            ],
            'admin/ads/list-ads' => [
                'title' => 'List ads',
                'shop_user' => true,
                'icon' => 'fa fa-plus',
                'url' => 'admin/ads/list-ads',
                'privs' => [67], // Priv Ids
            ],
        ]
    ],
];
