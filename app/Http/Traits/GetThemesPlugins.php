<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.12.2018
 * Time: 20:37
 */

namespace Corp\Http\Traits;


use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;
use Image;

trait GetThemesPlugins {
	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */

	public function getAllPlugins() {

		$plugin = null;

		$plugin_n = \Corp\Plugin::where( 'activated', true )->get();

		foreach ( Finder::create()->in( app_path() . DIRECTORY_SEPARATOR . 'Plugins' )->directories()->depth( 0 ) as $dir ) {
			//	dump(file_exists($dir->getPathname() . '/plugin.yaml'));
			if ( file_exists( $dir->getPathname() . '/plugin.yaml' ) ) {


				$arr = Yaml::parse( file_get_contents( $dir->getPathname() . '/plugin.yaml' ) );


				$arr['pathname'] = $dir->getBasename();

				if ( isset( $plugin_n->alias ) && ( $plugin_n->alias == $dir->getBasename() && $plugin_n->activated == true ) ) {
					$arr['activated'] = true;
				}
				foreach ( $plugin_n as $item ) {
					if ( isset( $item->alias ) && ( $item->alias == $dir->getBasename() && $item->activated == true ) ) {
						$arr['activated'] = true;
					}
				}
				$plugin[] = $arr;
			}


		}

		return $plugin;
	}

	public function getAllThemes() {
		$theme_a = \Corp\Theme::where( 'activated', true )->first();

		$theme = [];
		foreach ( Finder::create()->in( app_path() . DIRECTORY_SEPARATOR . 'Themes' )->directories()->depth( 0 ) as $dir ) {
			if ( file_exists( $dir->getPathname() . '/theme.yaml' ) ) {


				$arr = Yaml::parse( file_get_contents( $dir->getPathname() . '/theme.yaml' ) );
				if ( file_exists( $dir->getPathname() . DIRECTORY_SEPARATOR . 'screenshot.png' ) ) {
					$arr['screenshot'] = (string) Image::make( $dir->getPathname() . DIRECTORY_SEPARATOR . 'screenshot.png' )->encode( 'data-url' );
				}
				$arr['pathname'] = $dir->getBasename();

				if ( isset( $theme_a->alias ) && ( $theme_a->alias == $dir->getBasename() && $theme_a->activated == true ) ) {
					$arr['activated'] = true;
				}
				$theme[] = $arr;
			}


		}

		return $theme;
	}
}