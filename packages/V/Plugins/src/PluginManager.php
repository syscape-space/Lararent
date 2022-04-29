<?php

namespace V\Plugins;
use Cache;
use Corp\Permission;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class PluginManager {
	private $app;

	/**
	 * @var PluginManager
	 */
	private static $instance = null;
	public static $permission = null;

	/**
	 * @var string
	 */
	protected $pluginDirectory;

	/**
	 * @var string
	 */
	protected $themeDirectory;

	/**
	 * @var array
	 */
	protected $plugins = [];


	protected $themes = [];

	/**
	 * @var array
	 */
	protected $classMap = [];

	/**
	 * @var PluginExtender
	 */
	protected $pluginExtender;

	/**
	 * PluginManager constructor.
	 *
	 * @param $app
	 */
	public function __construct( $app ) {
		$this->app = $app;
		$this->pluginDirectory = $app->path() . DIRECTORY_SEPARATOR . 'Plugins';
		$this->themeDirectory = $app->path() . DIRECTORY_SEPARATOR . 'Themes';
		$this->pluginExtender = new PluginExtender( $this, $app );

		$this->bootPlugins();
		$this->bootThemes();

		$this->pluginExtender->extendAll();

		$this->registerClassLoader();
	}

	/**
	 * Registers plugin autoloader.
	 */
	private function registerClassLoader() {
		spl_autoload_register( [ new ClassLoader( $this ), 'loadClass' ], true, true );
	}

	/**
	 * @param $app
	 * @return PluginManager
	 */
	public static function getInstance( $app ) {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self( $app );
		}

		return self::$instance;
	}

	public function bootPlugins( $on_activated = false, $on_delete = false ) {
		if ( !lr_is_installed() ) {
			return;
		}



		$plugin_n =  \Corp\Plugin::where( 'activated', true )->get();



		foreach ( Finder::create()->in( $this->pluginDirectory )->directories()->depth( 0 ) as $dir ) {
			/** @var SplFileInfo $dir */

			$activated = false;
			$directoryName = $dir->getBasename();

			foreach ( $plugin_n as $item ) {
				if ( isset( $item->alias ) && ( $item->alias == $directoryName && $item->activated == true ) ) {
					$activated = true;
					break;
				}
			}

			if ( !$activated ) {
				continue;
			}

			$pluginClass = $this->getPluginClassNameFromDirectory( $directoryName );
			if ( !class_exists( $pluginClass ) ) {

				dd( 'Plugin ' . $directoryName . ' needs a ' . $directoryName . 'Plugin class. Plugin main php file need the same name as class' );
			}

			try {
				$plugin = $this->app->makeWith( $pluginClass, [ $this->app ] );
			} catch ( \ReflectionException $e ) {
				dd( 'Plugin ' . $directoryName . ' could not be booted: "' . $e->getMessage() . '"' );
				exit;
			}

			if ( !( $plugin instanceof Plugin ) ) {
				dd( 'Plugin ' . $directoryName . ' must extends the Plugin Base Class' );
			}

			$plugin->boot();


			// if admin activate tis theme in first time
			if ( $on_activated && method_exists( $plugin, 'onActivate' ) ) {
				$plugin->onActivate();

			}
			// add new permission to DB
			if ( $on_activated ) {

				$permission = $plugin->permission();

				if ( is_array( $permission ) ) {
					foreach ( $permission as $permission ) {
						Permission::firstOrCreate( [ 'name' => $permission ] );
					}
				}
			}

			if ( $on_delete && method_exists( $plugin, 'onDelete' ) ) {
				$plugin->onDelete();

			}
			$this->plugins[$plugin->name] = $plugin;
		}



	}


	/**
	 * we booth theme that user is activated
	 */
	public function bootThemes( $on_activated = false, $on_delete = false ) {
		if ( !lr_is_installed() ) {
			return;
		}
		$theme_a = \Corp\Theme::where( 'activated', true )->first();


		if ( isset( $theme_a->alias ) ) {

			foreach ( Finder::create()->in( $this->themeDirectory )->directories()->depth( 0 ) as $dir ) {

				if ( !( $theme_a->alias == $dir->getBasename() && $theme_a->activated == true ) ) {
					continue;
				}
				session( [ 'lr_active_theme_slug' => $theme_a->alias ] );
				if ( !headers_sent() ) {
					if ( session_status() === PHP_SESSION_NONE ) {
						session_start();
					}
				}
				$_SESSION["lr_active_theme_slug"] = $theme_a->alias;


				//	Session::set('lr_active_theme_slug', $theme_a->alias);
				$directoryName = $dir->getBasename();

				$themeClass = $this->getThemeClassNameFromDirectory( $directoryName );


				if ( !class_exists( $themeClass ) ) {

					dd( 'Theme ' . $directoryName . ' needs a ' . $directoryName . 'Theme class.' );
				}


				try {
					$theme = $this->app->makeWith( $themeClass, [ $this->app ] );
				} catch ( \ReflectionException $e ) {
					dd( 'Theme ' . $directoryName . ' could not be booted: "' . $e->getMessage() . '"' );
					exit;
				}

				if ( !( $theme instanceof Theme ) ) {
					dd( 'Theme ' . $directoryName . ' must extends the Theme Base Class' );
				}

				$theme->boot();


				// if admin activate tis theme in first time
				if ( $on_activated && method_exists( $theme, 'onActivate' ) ) {
					$theme->onActivate();
				}
				if ( $on_delete && method_exists( $theme, 'onDelete' ) ) {
					$theme->$on_delete();
				}
				$this->themes[$theme->name] = $theme;
			}
		}

	}


	/**
	 * @param $directory
	 * @return string
	 */
	protected function getPluginClassNameFromDirectory( $directory ) {
		return "Corp\\Plugins\\${directory}\\${directory}Plugin";
	}

	protected function getThemeClassNameFromDirectory( $directory ) {
		return "Corp\\Themes\\${directory}\\${directory}Theme";
	}

	/**
	 * @return array
	 */
	public function getClassMap() {
		return $this->classMap;
	}

	/**
	 * @param array $classMap
	 * @return $this
	 */
	public function setClassMap( $classMap ) {
		$this->classMap = $classMap;

		return $this;
	}

	/**
	 * @param $classNamespace
	 * @param $storagePath
	 */
	public function addClassMapping( $classNamespace, $storagePath ) {
		$this->classMap[$classNamespace] = $storagePath;
	}

	/**
	 * @return array
	 */
	public function getPlugins() {
		return $this->plugins;
	}

	/**
	 * @return string
	 */
	public function getPluginDirectory() {
		return $this->pluginDirectory;
	}

	public function getThemeDirectory() {
		return $this->themeDirectory;
	}
}
