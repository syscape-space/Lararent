<?php
return [

	'lr_version' => '1.0.4',
	'theme' => env( 'THEME', 'default' ),
	'admin-name' => 'lararent Admin',
	'admin' => env( 'ADMIN', 'admins' ),
	'registered_nav_menus' => [
		'header-menu' => 'Header menu',
		'footer-menu' => 'Footer menu',
		'sidebar-menu' => 'Sidebar menu',

	],

	'registered_sidebars' => [
		'rentit-sidebar' => 'Rentit sidebar',
		//	'rentit-shop-sidebar' => 'Rentit shop sidebar',
		'rentit-footer-sidebar' => 'Rentit footer sidebar',

	],


	'slider_path' => 'slider-cycle',
	'home_port_count' => 5,
	'home_articles_count' => 3,
	'paginate' => 4,
	'recent_comments' => 3,
	'recent_portfolios' => 3,
	'other_portfolios' => 8,


	'permission' => [
		'VIEW_ADMIN_PAGES',
		'ADD_PAGES',
		'UPDATE_PAGES',
		'DELETE_PAGES',
		'VIEW_COMMENTS',
		'UPDATE_COMMENTS',
		'VIEW_PORTFOLIO_CATEGORY',
		'VIEW_CATEGORY',
		'ADD_CATEGORY',
		'UPDATE_CATEGORY',
		'DELETE_CATEGORY',
		'VIEW_PORTFOLIO',
		'UPDATE_PORTFOLIO',
		'ADD_PORTFOLIO',
		'MEDIAS.VIEW',
		'REGENERATE_THUMBNAILS',
		'VIEW_PORTFOLIO',
		'UPDATE_PORTFOLIO',
		'ADD_PORTFOLIO',
		'VIEW_PRODUCT_CATEGORY',
		'ADD_PRODUCT_CATEGORY',
		'UPDATE_PRODUCT_CATEGORY',
		'DELETE_PRODUCT_CATEGORY',
		'VIEW_ECOMMERCE',
		'VIEW_LOCATION',
		'EDIT_LOCATION',
		'VIEW_REPORTS',
		'VIEW_APPEARANCE',
		'EDIT_APPEARANCE',
		'VIEW_PLUGINS',
		'EDIT_PLUGINS',
		'VIEW_OPTIONS',
		'EDIT_OPTIONS',
		'VIEW_USERS',
		'EDIT_USERS',
		'VIEW_USERS_PERMISSION',
		'EDIT_USERS_PERMISSION',
		'VIEW_TRANSLATES',
		'EDIT_TRANSLATES',
		'VIEW_CUSTOMIZE',
		'EDIT_CUSTOMIZE',


	]




];

?>
