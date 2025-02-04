<?php

return [

/*
|--------------------------------------------------------------------------
| Title
|--------------------------------------------------------------------------
|
| Here you can change the default title of your admin panel.
|
*/

'title' => '商品管理',
'title_prefix' => '',
'title_postfix' => '',

/*
|--------------------------------------------------------------------------
| Favicon
|--------------------------------------------------------------------------
|
| Here you can activate the favicon.
|
*/

'use_ico_only' => false,
'use_full_favicon' => false,

/*
|--------------------------------------------------------------------------
| Google Fonts
|--------------------------------------------------------------------------
|
| Here you can allow or not the use of external google fonts.
|
*/

'google_fonts' => [
    'allowed' => true,
],

/*
|--------------------------------------------------------------------------
| Admin Panel Logo
|--------------------------------------------------------------------------
|
| Here you can change the logo of your admin panel.
|
*/

'logo' => '<b>テックフルーツ</b>',
'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
'logo_img_class' => 'brand-image img-circle elevation-3',

/*
|--------------------------------------------------------------------------
| Authentication Logo
|--------------------------------------------------------------------------
|
| Here you can setup an alternative logo to use on your login and register
| screens.
|
*/

'auth_logo' => [
    'enabled' => false,
    'img' => [
        'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
        'alt' => 'Auth Logo',
        'class' => '',
        'width' => 50,
        'height' => 50,
    ],
],

/*
|--------------------------------------------------------------------------
| Preloader Animation
|--------------------------------------------------------------------------
|
| Here you can change the preloader animation configuration.
|
*/

'preloader' => [
    'enabled' => true,
    'img' => [
        'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
        'alt' => 'AdminLTE Preloader Image',
        'effect' => 'animation__shake',
        'width' => 60,
        'height' => 60,
    ],
],

/*
|--------------------------------------------------------------------------
| User Menu
|--------------------------------------------------------------------------
|
| Here you can activate and change the user menu.
|
*/

'usermenu_enabled' => true,
'usermenu_header' => false,

/*
|--------------------------------------------------------------------------
| Layout
|--------------------------------------------------------------------------
|
| Here we change the layout of your admin panel.
|
*/

'layout_topnav' => null,
'layout_boxed' => null,
'layout_fixed_sidebar' => true,
'layout_fixed_navbar' => null,
'layout_fixed_footer' => null,
'layout_dark_mode' => null,

/*
|--------------------------------------------------------------------------
| Authentication Views Classes
|--------------------------------------------------------------------------
|
| Here you can change the look and behavior of the authentication views.
|
*/

'classes_auth_card' => 'card-outline card-primary',
'classes_auth_btn' => 'btn-flat btn-primary',

/*
|--------------------------------------------------------------------------
| Admin Panel Classes
|--------------------------------------------------------------------------
|
| Here you can change the look and behavior of the admin panel.
|
*/

'classes_sidebar' => 'sidebar-dark-primary elevation-4',
'classes_topnav' => 'navbar-white navbar-light',

/*
|--------------------------------------------------------------------------
| Sidebar
|--------------------------------------------------------------------------
|
| Here we can modify the sidebar of the admin panel.
|
*/

'sidebar_mini' => 'lg',
'sidebar_nav_accordion' => false,

/*
|--------------------------------------------------------------------------
| URLs
|--------------------------------------------------------------------------
|
| Here we can modify the url settings of the admin panel.
|
*/

'dashboard_url' => '/',
'logout_url' => 'logout',
'login_url' => 'login',

/*
|--------------------------------------------------------------------------
| Menu Items
|--------------------------------------------------------------------------
|
| Here we can modify the sidebar/top navigation of the admin panel.
|
*/

'menu' => [
    [
        'text' => '商品一覧',
        'url'  => 'item',
        'icon' => 'fas fa-gamepad',
    ],
    [
        'text' => '商品登録',
        'url'  => 'item/add',
        'icon' => 'fas fa-pen',
        //'can'  => 'is_corporate_or_master', // 法人ユーザーまたはマスターのみアクセス
    ],
    
    [
        'text' => '商品購入カゴ',
        'url'  => 'item/cart',
        'icon' => 'fas fa-shopping-cart',
    ],
],


/*
|--------------------------------------------------------------------------
| Menu Filters
|--------------------------------------------------------------------------
|
| Here we can modify the menu filters of the admin panel.
|
*/

];
