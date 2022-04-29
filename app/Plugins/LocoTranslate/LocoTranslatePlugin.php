<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09.08.2018
 * Time: 11:31
 */

namespace Corp\Plugins\LocoTranslate;



use App;
use Auth;
use Eventy;
use Gate;
use Illuminate\Contracts\Foundation\Application;
use V\Plugins\Plugin;

class  LocoTranslatePlugin  extends Plugin {
	public $name = 'LocoTranslate';
	public $registerModule;

	public function __construct( Application $app ) {
		parent::__construct( $app );
		$this->user = Auth::user();
		$this->baseCms = app()->make( 'BaseCms' );



	}
	public function boot() {
		$this->enableRoutes();
		$this->enableViews();
		$this->registerPolicy();
		$this->baseCms->addBackendMenu(
			[

				'name' => __( 'Translate' ),
				'label' => '',

				'url' => route( 'admin.translates' ),
				'icon' => 'fa  fa-flag-checkered',
				'permissions' => [ 'VIEW_TRANSLATES' ],
				'order' => 15,



			]
		);


	}

	public function permission() {
		// TODO: Implement permission() method.
		return [
			'CanTranslate'
		];
	}

	 public function registerPolicy() {

		Gate::define( 'CanTranslate', function ( $user ) {
			return $user->canDo( 'CanTranslate' );
		} );
	}
}