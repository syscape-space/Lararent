<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.10.2018
 * Time: 12:04
 */

namespace Corp\Themes\RentIt\Classes;
use URL ;

/**
 * Menu walker it's build theme header menu
 * Class MenuWalker
 * @package Corp\Themes\RentIt\Classes
 */
class MenuWalker {

	public $megaMenu = false;

	/**
	 * recursive build menu
	 * @param $arr
	 * @param $menu
	 * @param int $level
	 * @param null $parent_item
	 * @return string
	 */
	public function display_element( $arr, $menu, $level = 0, $parent_item = null ) {

		$text = $this->start_lvl( $arr, $level );
		foreach ( $menu as $k => $item ) {
			$text .= $this->start_el( $arr, $item, $parent_item, $level );
			if ( isset( $item->children ) ) {
				$text .= $this->display_element( $arr, $item->children, ++ $level, $item );
			}
			$text .= $this->end_el( $level , $parent_item);
		}

		$text .= $this->end_lvl( $level );

		return $text;
	}

	/**
	 * @param $arr
	 * @param int $level
	 * @return string
	 */
	public function start_lvl( $arr, $level = 0 ) {
		$text = '';
		if ( $level == 0 ) {
			$text = '<ul class="' . $arr['container_class'] . '">' . "\r\n";;

		} else {
			$text = '<ul>' . "\r\n";

		}
		if ( $this->megaMenu ) {
			$text .= '<li class=\'row newsdfsadf\'>';
		}

		return $text;


	}

	/**
	 * @param int $level
	 * @param int $depth
	 * @return string
	 */
	public function end_lvl( $level = 0, $depth = 0 ) {


		if ( $this->megaMenu == true && $depth == 0 ) {
			return "</li></ul>\n";
		} else {
			return '</ul>';
		}

	}

	/**
	 * Build link
	 * @param $arr
	 * @param $item
	 * @param $parent_item
	 * @param int $depth
	 * @return string
	 */
	public function start_el( $arr, $item, $parent_item, $depth = 0 ) {

		$el_cllas = isset( $arr['el_class']{1} ) ? "class='" . $arr['el_class'] . "'" : '';
		$link_class = isset( $arr['link_class']{1} ) ? "class='" . $arr['link_class'] . "'" : '';
		$text = '';
		$item->href  = str_replace('{SITE_URL}',url('/'), $item->href );
		if ( isset( $item->megamenu ) && ( $item->megamenu === 'yes' ) ) {
			$this->megaMenu = true;

			$text = '<li class="megamenu sale " > <a ' . $link_class . ' href="' . $item->href . '"> ' . '' . $item->text . ' </a> ' . "\r\n";;

		} else {
			$this->megaMenu = false;
			if ( isset( $parent_item->megamenu ) && $parent_item->megamenu === 'yes' ) {
				$text =  '<div class="col-md-3">   <h4 class="block-title"><span>'. $item->text  .'</span></h4>'  . "\r\n";
				if(isset($item->Description)){
					$text .= $item->Description;
				}

			} else {
				$text = '<li ' . $el_cllas . '> <a ' . $link_class . ' href="' . $item->href . '"> ' . '' . $item->text . ' </a> ' . "\r\n";

			}
		}
		return $text;

	}


	/**
	 * Close elements
	 * @param $level
	 * @param $parent_item
	 * @return string
	 */
	public function end_el( $level , $parent_item) {

		$n = "\n";
		if ( isset( $parent_item->megamenu ) && $parent_item->megamenu === 'yes' ) {
			return "</div>{$n}";
		} else {
			return "</li>{$n}";
		}


	}

}