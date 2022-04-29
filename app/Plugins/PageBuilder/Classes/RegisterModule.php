<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.11.2018
 * Time: 19:18
 */

namespace Corp\Plugins\PageBuilder\Classes;

use Illuminate\Support\Collection;

class RegisterModule {
	private static
		$instance = null;

	private $modules;

	/**
	 * RegisterModule constructor.
	 */
	private function __construct() {

	}


	/**
	 * @return Singleton
	 */
	public static function getInstance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * @return mixed
	 */
	public function getModules() {
		return $this->modules;
	}

	/**
	 * @param mixed $modules
	 */
	public function setModule( $id,$name, $path , $img, $type,$priority = 10): void {
		$this->modules[$id]  = [
			'name' => $name,
			'path' => $path,
			'img' => $img,
			'type' => $type,
			'priority' => $priority,


		];
	}

	private function __clone() {
	}




}