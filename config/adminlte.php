<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'CSTMS',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Construction</b>TMS',

    'logo_mini' => 'TMS',
/*<b>CS</b>*/
    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => 'POST',

    'login_url' => 'login',
    'register_url' => 'register',

    'mng_manager_url' => 'usr',
    'mng_contractor_url' => 'usr',
    'mng_labor_url' => 'usr',
    'mng_supplier_url' => 'usr',
    //'mng_project_url' => 'project/create',
    'addlabor_url' => 'labors/addlabor',



   

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
       
        'MAIN NAVIGATION',
         [
            'text' => 'Dashboard',
            'url'  => 'home',
            'icon' => 'dashboard',
        ],
        [
            'text'        => 'Profile',
            'url'         => '/profile',
            'icon'        => 'user',
            /*'label'       =>  4,
            'label_color' => 'success',*/
        ],
        'General links',
         [
            'text' => 'Create Project',
            'url'  => 'projects/create',
            'icon' => 'ion ion-android-add-circle',
        ],
         [
            'text' => 'Add Customer Payment',
            'url'  => 'customer-payment/create',
            'icon' => 'ion ion-cash',
        ],
         [
            'text' => 'Material Requests',
            'url' => '/materialrequest',
            'icon' => 'ion ion-pull-request',  
        ],
        [
            'text' => 'Add Expense',
            'url'  => 'expenses/create',
            'icon' => 'ion ion-cash',
        ],
         [
            'text' => 'Add Order',
            'url'  => 'orders/create',
            'icon' => 'ion ion-android-add'
        ],
        'Customers',
        [
            'text' => 'Customers',
            'url'  => '/allcustomers',
            'icon' => 'ion ion-ios-people-outline',
        ],
      

        'Manage',
        [
            'text'    => 'Orders',
            'icon'    => 'ion ion-ios-albums-outline',
            'submenu' => [
                [
                    'text' => 'View All Orders',
                    'url' => '/orders',
                    'icon' => 'ion ion-ios-list-outline'
                ],
                [
                    'text' => 'Add Order',
                    'url'  => 'orders/create',
                    'icon' => 'ion ion-android-add-circle'
                ],
                
              
            ],
        ],
        [
            'text'    => 'Labors',
            'icon'    => 'ion ion-ios-people-outline',
            'submenu' => [
                [
                    'text' => 'View All Labors',
                    'url' => '/labors',
                    'icon' => 'ion ion-ios-list-outline'
                    
                ],
                [
                    'text' => 'Add Labor',
                    'url'  => 'labors/create',
                    'icon' => 'ion ion-person-add'
                ],
                
              
            ],
        ],
        [
            'text'    => 'Projects',
            'icon'    => 'ion ion-home',
            'submenu' => [
                 [
                    'text' => 'Projects Detail',
                    'url'  => 'projects',
                    'icon' => 'ion ion-ios-list'
                ],
                 [
                    'text' => 'All Projects',
                    'url'  => 'projects/all',
                    'icon' => 'ion ion-ios-list-outline'
                ],
                [
                    'text' => 'Create Project',
                    'url'  => 'projects/create',
                    'icon' => 'ion ion-android-add-circle'
                ],
               
            ],
        ],

         [
            'text'    => 'Expenses',
            'icon'    => 'ion ion-ios-browsers-outline',
            'submenu' => [
                 [
                    'text' => 'Project Expenses',
                    'url' => '/expenses',
                    'icon' => 'ion ion-ios-list-outline'
                ],
                [
                    'text' => 'Company Expenses',
                    'url' => '/company-expenses',
                    'icon' => 'ion ion-ios-list-outline'
                ],
                [
                    'text' => 'Add Expense',
                    'url'  => 'expenses/create',
                    'icon' => 'ion ion-android-add-circle'

                ],
            ],
        ],

        [
            'text'    => 'Payments',
            'icon'    => 'ion ion-ios-barcode-outline',
            'submenu' => [
                 [
                    'text' => 'View Customer Payments',
                    'url' => 'customer-payment',
                    'icon' => 'ion ion-ios-list-outline'
                ],
                [
                    'text' => 'Add Customer Payment',
                    'url'  => 'customer-payment/create',
                    'icon' => 'ion ion-cash'

                ],
                 [
                    'text' => 'Supplier Payments',
                    'url' => 'supplier-payment',
                    'icon' => 'ion ion-ios-list-outline'
                ],
                [
                    'text' => 'Add Supplier Payment',
                    'url'  => 'supplier-payment/create',
                    'icon' => 'ion ion-cash'
                ],
            ],
        ],
         [
            'text'    => 'Items',
            'icon'    => 'ion ion-ios-infinite',
            'submenu' => [
                [
                    'text' => 'View All Items',
                    'url' => 'items',
                    'icon' => 'ion ion-ios-list-outline'
                ],
                [
                    'text' => 'Add Items',
                    'url'  => 'items/create',
                    'icon' => 'ion ion-android-add-circle'

                ],
            ],
        ],
         [
            'text'    => 'User',
            'icon'    => 'ion ion-ios-people-outline',
            'submenu' => [
                 [
                    'text' => 'View All User',
                    'url' => 'users',
                    'icon' => 'ion ion-ios-list-outline'
                ],
                [
                    'text' => 'Add User',
                    'url'  => 'users/create',
                    'icon' => 'ion ion-person-add'
                ],
               
              
            ],
        ],
         [
            'text'    => 'Supplier',
            'icon'    => 'fa fa-handshake-o',
            'submenu' => [
                [
                    'text' => 'View All Supplier',
                    'url' => 'suppliers/all',
                    'icon' => 'ion ion-ios-list-outline'
                ],
                [
                    'text' => 'Add Supplier',
                    'url'  => 'suppliers/create',
                    'icon' => 'ion ion-android-add-circle'
                ],
               
              
            ],
        ],

        
        'Reports Management',
         [
            'text'    => 'Reports',
            'icon'    => 'ion ion-stats-bars',
            'submenu' => [
                [
                    'text' => 'Project Expenses',
                    'url' => 'expensereport',
                    'icon' => 'ion ion-alert'
                ],
                [
                    'text' => 'Project Orders',
                    'url'  => 'projectreport',
                    'icon' => 'ion ion-grid:'
                ],
               
              
            ],
        ],
                [
                    'text' => 'Daily',
                    'url' => 'report',
                    'icon' => 'file'
                ],
                [
                    'text' => 'Weekly',
                    'url' => 'report/weekly',
                    'icon' => 'file'
                ],
                [ 
                    'text' => 'Monthly',
                    'url' => 'report/monthly',
                    'icon' => 'file'
                ],
      /*  'LABELS',
        [
            'text' => 'Material Requests',
            'url' => 'home',
            'icon_color' => 'red',
        ],
        [
            'text'       => 'User',
            'icon_color' => 'usr',
        ],
        [
            'text'       => 'Information',
            'icon_color' => 'aqua',
        ],*/
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
    ],
];
