<?php

namespace Corp\Providers;

use Corp\Menu;
use Corp\Plugins\eCommerce\Models\Product;
use Corp\Plugins\eCommerce\Policies\ProductPolicy;
use Corp\Policies\MenuPolicy;
use Corp\Policies\PostPolicy;
use Corp\Post;
use Eventy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
	    Post::class => PostPolicy::class,
	    Menu::class => MenuPolicy::class,
	    Product::class => ProductPolicy::class
    ];

    public  function __construct( \Illuminate\Contracts\Foundation\Application $app ) {
	    parent::__construct( $app );
	  //  $this->policies =  Eventy::filter('AuthServiceProvider.policies',  $this->policies );


    }

	/**
     * Register any authentication / authorization services.
     *
     * @return void
     */

    public function boot()
    {
        $this->registerPolicies();



	    Gate::before(function ($user) {
		    if ($user->isSuperAdmin()) {
			    return true;
		    }
	    });


	    Gate::define('VIEW_ADMIN', function ($user) {
		    return $user->canDo('VIEW_ADMIN', FALSE);
	    });
	    Gate::define('ADD_POSTS', function ($user) {

		    return $user->canDo('ADD_POSTS', FALSE);
	    });



	    Gate::define('VIEW_ADMIN_POSTS', function ($user) {
		    return $user->canDo('VIEW_ADMIN_POSTS', FALSE);
	    });

	    Gate::define('EDIT_USERS', function ($user) {
		    return $user->canDo('EDIT_USERS', FALSE);

	    });
	    Gate::define('VIEW_ADMIN_MENU', function ($user) {
		    return $user->canDo('VIEW_ADMIN_MENU', FALSE);
	    });


	    Gate::define('REGENERATE_THUMBNAILS_ADMIN', function ($user) {
		    return $user->canDo('VIEW_ADMIN_POSTS', FALSE);
	    });



	    Eventy::action('AuthServiceProvider.hook');
	    $permission = config('settings.permission');
	    if($permission){
	    	foreach ($permission as $perm){
			    Gate::define($perm, function ($user) use($perm) {
				    return $user->canDo($perm, FALSE);
			    });

		    }
	    }

	    
        //
    }
}
