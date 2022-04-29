<?php

namespace Corp\Plugins;

use Eventy;
use Illuminate\Support\ServiceProvider;

class PluginBase extends ServiceProvider {


	/**
	 * @var boolean
	 */
	protected $loadedYamlConfiguration = false;

	/**
	 * @var array Plugin dependencies
	 */
	public $require = [];

	/**
	 * @var boolean Determine if this plugin should have elevated privileges.
	 */
	public $elevated = false;

	/**
	 * @var boolean Determine if this plugin should be loaded (false) or not (true).
	 */
	public $disabled = false;
	public $app = false;

	public function __construct() {

		/*Eventy::addFilter('my.hook', function($what) {
			$what = 'not 22'. $what;
			return $what;
		}, 20, 1);*/

	}


	/**
	 * Register method, called when the plugin is first registered.
	 *
	 * @return void
	 */
	public function register() {
	}

	/**
	 * Boot method, called right before the request route.
	 *
	 * @return array
	 */
	public function boot() {
		dd(2);
	}

	/**
	 * Registers any front-end components implemented in this plugin.
	 *
	 * @return array
	 */
	public function registerComponents() {
		return [];


	}

	/**
	 * Registers back-end navigation items for this plugin.
	 *
	 * @return array
	 */
	public function registerNavigation()
	{
		/*$configuration = $this->getConfigurationFromYaml();
		if (array_key_exists('navigation', $configuration)) {
			$navigation = $configuration['navigation'];

			if (is_array($navigation)) {
				array_walk_recursive($navigation, function (&$item, $key) {
					if ($key === 'url') {
						$item = Backend::url($item);
					}
				});
			}

			return $navigation;
		}*/
	}


}

?>