<?php

/**
 * All copyright protected by Victor victorkri200@gmail.com
 */

namespace Corp\CMS;


use Auth;
use Cache;
use Corp\Locations_menu;
use Corp\Widget;
use Eventy;
use Illuminate\Support\Collection;

/**
 * Class BaseCms
 * @package Corp\CMS
 */
class  BaseCms {

	public $backendMenu;
	protected $widgets;
	protected $sidebars;
	protected $images_size;
	protected $admin_js;
	protected $admin_css;
	protected $frontend_css;
	protected $frontend_js;
	protected $modules;

	public $options;


	/**
	 * BaseCms constructor.
	 */
	public function __construct() {
		if ( !lr_is_installed() ) {
			return;
		}

		$this->backendMenu = new Collection();
		$this->widgets = new Collection();
		$this->sidebars = new Collection();
		$this->images_size = new Collection();
		$this->admin_js = new Collection();
		$this->admin_css = new Collection();
		$this->frontend_css = new Collection();
		$this->frontend_js = new Collection();

		$this->options = \Corp\Option::get();


	}


	/**
	 * @param $arr
	 * @param int $order
	 */
	public function addBackendMenu( $arr, $order = 20 ) {


		$this->backendMenu->push( $arr );
	}

	/**
	 * @return Collection
	 */
	public function getBackendMenu() {

		return $this->backendMenu->sortBy( 'order' );
	}

	public function searchMenu( $name, $arr ) {
		$key = $this->backendMenu->search( function ( $item, $key ) use ( $name ) {
			return $item['slug'] ?? '' == $name;
		} );
		$this->backendMenu->put( $key, $arr );

	}

	/**
	 * @param $arr
	 */
	public function addWidgets( $arr ) {

		$this->widgets->push( $arr );
	}

	/**
	 * @return Collection
	 */
	public function getRegisteredWidgets() {

		return $this->widgets;
	}

	/**
	 * @param $arr
	 */
	public function registerSidebar( $arr ) {

		$this->sidebars[] = ( $arr );
	}

	/**
	 * @return Collection
	 */
	public function getDynamicSidebars() {

		return $this->sidebars;
	}

	/***
	 * @param $s
	 */
	public function dynamicSidebar( $s ) {


		$filtered = $this->sidebars->filter( function ( $value, $key ) use ( $s ) {
			return $value['id'] == $s;
		} );

		//array_merge( $filtered->shift(),[0]);

		//		$widgets =  Widget::with( 'translations' )->where( 'sidebar', $s )->orderBy( 'position', 'asc' )->get();


		$widgets = Cache::remember( 'dynamicSidebar_id_' . $s, 1440, function () use ( $s ) {
			return Widget::with( 'translations' )->where( 'sidebar', $s )->orderBy( 'position', 'asc' )->get();
		} );


		$args = $filtered->shift();
		if ( !empty( $widgets ) && is_object( $widgets ) ) {
			foreach ( $widgets as $widget ) {
				$args['number'] = $widget->position;
				$obj = $widget->callback;
				$obj = new $obj();

				$obj->display_callback( $args, $widget->position, $widget->id, $widget->output );

			}
		}

	}

	/**
	 * @param $s
	 * @return bool
	 */
	public function dynamicSidebarExits( $s ) {
		$widgets = Widget::where( 'sidebar', $s )->orderBy( 'position', 'asc' )->get();
		return empty( $widgets );
	}

	/**
	 * @return mixed
	 */
	public function getImagesSize() {
		return $this->images_size;
	}

	/**
	 * @param mixed $images_size
	 */
	public function setImagesSize( $images_size ): void {
		//$this->images_size->push( $images_size );
		foreach ( $images_size as $k => $v ) {
			array_add( $this->images_size, $k, $v );
		}
	}


	/***
	 * It's display registered theme menu
	 * @param array $arr
	 * @return bool
	 */
	public function nav_menu( $arr = [] ) {
		$arr = lr_parse_args( $arr, [
			'theme_location' => null,
			'walker' => new  \Corp\Repositories\MenuWalker(),
			'container_class' => 'nav sf-menu',
			'el_class' => '',
			'link_class' => '',
			'echo' => true
		] );
		$walker = $arr['walker'];
		if ( $arr['theme_location'] == null ) {
			return false;
		}

	//	$menu = Cache::remember( App()->getLocale() . 'CMS_MENU.' . $arr['theme_location'], 10000, function () use ( $arr, $walker ) {


			$menu_n = Locations_menu::where( 'locations', $arr['theme_location'] )->first();

			if ( $menu_n ) {
				$menu = json_decode( $menu_n->menu()->first()->output );

                $menu	= Eventy::filter( 'lr.menu', $walker->display_element( $arr, $menu, 0 ) );
			}
	//	} );

        $menu .= "";
		if ( $menu ) {
			if ( $arr['echo'] ) {
				echo $menu;
			} else {
				return $menu;
			}
		}
	}

	/**
	 * @param mixed $frontend_css
	 * @return BaseCms
	 */
	public function setFrontendCss( $name, $src = '', $deps = array(), $ver = false, $priority = 20 ) {

		$this->frontend_css[$name] = [
			'name' => $name,
			'path' => $src,
			'deps' => $deps,
			'ver' => $ver,
			'priority' => $priority
		];

		return $this;

	}

	/**
	 * @return mixed
	 */
	public function getFrontendCss() {
		return $this->frontend_css;
	}

	/**
	 * @return mixed
	 */
	public function getFrontendJs() {
		return $this->frontend_js;
	}


	/**
	 * @param mixed $frontend_js
	 */
	public function setFrontendJs( $name, $path = '', $deps = array(), $ver = false, $in_footer = true, $priority = 20, $object_name = false, $obj = [] ) {
		$this->frontend_js[$name] = [
			'name' => $name,
			'path' => $path,
			'deps' => $deps,
			'ver' => $ver,
			'in_footer' => $in_footer,
			'priority' => $priority,
			'object_name' => $object_name,
			'obj' => $obj,

		];

		return $this;
	}

	public function localizedFrontendJs( $name, $object_name, $obj ) {

		$js = $this->frontend_js->toArray();
		$js[$name]['object_name'] = $object_name;
		$js[$name]['obj'] = $obj;
		$this->frontend_js = collect( $js );

	}

	public function getLocalizedFrontendJs( $name ) {
		$js = $this->frontend_js->toArray();
		if ( $js[$name]['obj'] ?? false ) {
			return $js[$name]['obj'];
		}

		return null;
	}

	public function localizedAdminJs( $name, $object_name, $obj ) {


		$js = $this->admin_js->toArray();
		$js[$name]['object_name'] = $object_name;
		$js[$name]['obj'] = $obj;
		$this->admin_js = collect( $js );


	}

	/**
	 * @return mixed
	 */
	public function getAdminJs() {
		return $this->admin_js;
	}

	/**
	 * @param mixed $admin_js
	 */
	public function setAdminJs( $name, $path = '', $deps = array(), $ver = false, $in_footer = false, $priority = 20 ) {
		$this->admin_js[$name] = [
			'name' => $name,
			'path' => $path,
			'deps' => $deps,
			'ver' => $ver,
			'in_footer' => $in_footer,
			'priority' => $priority

		];
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAdminCss() {
		return $this->admin_css;
	}


	/**
	 * @param $name
	 * @param string $src
	 * @param array $deps
	 * @param bool $ver
	 * @return $this
	 */
	public function setAdminCss( $name, $src = '', $deps = array(), $ver = false, $priority = 20 ) {
		$this->admin_css[$name] = [
			'name' => $name,
			'path' => $src,
			'deps' => $deps,
			'ver' => $ver,
			'priority' => $priority
		];
		return $this;

	}


}
