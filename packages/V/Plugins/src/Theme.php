<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 18.07.2018
 * Time: 14:51
 */

namespace V\Plugins;

use Corp\Http\Controllers\Frontend\FrontendController;
use Eventy;
use View;

abstract class Theme extends FrontendController {

	protected $app;
	public $namespace;
	/**
	 * The Theme Name.
	 *
	 * @var string
	 */
	public $name;

	/**
	 * A description of the theme.
	 *
	 * @var string
	 */
	public $description;

	/**
	 * The version of the theme.
	 *
	 * @var string
	 */
	public $version;

	/**
	 * @var $this
	 */
	private $reflector = null;

	/**
	 * Theme constructor.
	 *
	 * @param $app
	 */
	public function __construct() {
		parent:: __construct();
		$this->app = app();;
		$this->checkThemeName();
	}

	public function getTemplate( $name, $arr = null ) {


		if ( !View::exists( $this->getViewNamespace() . '::' . $name ) ) {
			return false;
		}
		if ( is_array( $arr ) ) {
			return view( $this->getViewNamespace() . '::' . $name )
				->with( $arr )
				->render();
		} else {
			return view( $this->getViewNamespace() . '::' . $name )
				->render();
		}
	}


	abstract public function boot();

	/**
	 * Check for empty theme name.
	 *
	 * @throws \InvalidArgumentException
	 */
	private function checkThemeName() {
		if ( !$this->name ) {
			throw new \InvalidArgumentException( 'Missing Theme name.' );
		}
	}

	/**
	 * Returns the view namespace in a camel case format based off
	 * the themes class name, with theme stripped off the end.
	 *
	 * Eg: ArticlesTheme will be accessible through 'theme:articles::<view name>'
	 *
	 * @return string
	 */
	protected function getViewNamespace() {
		return 'theme:' . $this->namespace;

	}

	/**
	 * Add a view namespace for this theme.
	 * Eg: view("theme:articles::{view_name}")
	 *
	 * @param string $path
	 */
	protected function enableViews( $path = 'views' ) {



		$this->app['view']->addNamespace(
			$this->getViewNamespace(),
			$this->getThemePath() . DIRECTORY_SEPARATOR . $path

		);



		$this->app['translator']->addNamespace(
			$this->namespace,
			$this->getLangPath() . DIRECTORY_SEPARATOR . 'lang'

		);


		$this->app['translator']->addJsonPath(
			$this->getLangPath() . DIRECTORY_SEPARATOR . 'lang'

		);


//		$this->app['Lang']->addNamespace('package', 	$this->getLangPath() . DIRECTORY_SEPARATOR . 'lang');
//		$this->app['Lang']->addJsonPath($this->getLangPath() . DIRECTORY_SEPARATOR . 'lang');

	}

	/**
	 * Enable routes for this theme.
	 *
	 * @param string $path
	 */
	protected function enableRoutes( $path = 'routes.php' ) {

		$this->app->router->group( [ 'namespace' => $this->getThemeControllerNamespace() ], function ( $app ) use ( $path ) {

			$file = $this->getThemePath() . DIRECTORY_SEPARATOR . $path;
			if ( file_exists( $file ) ) {
				require $file;
			} else {
				dd( "make sure that you have such a file " . $file );
			}

		} );
	}

	/**
	 * Register a database migration path for this theme.
	 *
	 * @param  array|string $paths
	 * @return void
	 */
	protected function enableMigrations( $path = 'migrations' ) {
		$this->app->afterResolving( 'migrator', function ( $migrator ) use ( $paths ) {
			foreach ( (array) $paths as $path ) {
				$migrator->path( $this->getThemePath() . DIRECTORY_SEPARATOR . $path );
			}
		} );
	}

	/**
	 * @return string
	 */
	public function getThemePath() {
		$reflector = $this->getReflector();
		$fileName = $reflector->getFileName();

		return dirname( $fileName );
	}

	public function getLangPath() {

	return str_replace( 'views', 'lang', $this->getThemePath() );
}

	/**
	 * @return string
	 */
	protected function getThemeControllerNamespace() {
		$reflector = $this->getReflector();
		$baseDir = str_replace( $reflector->getShortName(), '', $reflector->getName() );

		return $baseDir . 'Http\\Controllers';
	}

	/**
	 * @return \ReflectionClass
	 */
	private function getReflector() {
		if ( is_null( $this->reflector ) ) {
			$this->reflector = new \ReflectionClass( $this );
		}

		return $this->reflector;
	}

	/**
	 * Returns a theme view
	 *
	 * @param $view
	 * @return \Illuminate\View\View
	 */
	protected function view( $view ) {

		return view( $this->getViewNamespace() . '::' . $view );
	}
}
