<?php

namespace Corp\Repositories;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 17.07.2018
 * Time: 12:56
 */
Class MenuWalker {

	public function __construct() {

	}


	public function display_element( $arr, $menu, $level = 0 ) {

		$text = $this->start_lvl( $arr, $level );
		foreach ( $menu as $k => $item ) {


			$text .= $this->start_el( $arr, $item, $level );
			if ( isset( $item->children ) ) {
				$text .= $this->display_element( $arr, $item->children, ++ $level );

			}
			$text .= $this->end_el( $level );
		}

		$text .= $this->end_lvl( $level );
		return $text;
	}

	public function start_lvl( $arr, $level = 0 ) {
		$text = '';
		if ( $level == 0 ) {
			$text = '<ul class="' . $arr['container_class'] . '">' . "\r\n";;

		} else {
			$text = '<ul>' . "\r\n";

		}

		return $text;


	}

	public function end_lvl( $level = 0 ) {

		return '</ul>';


	}

	public function start_el( $arr, $item, $depth = 0 ) {
		$el_cllas = isset( $arr['el_class']{1} ) ? "class='" . $arr['el_class'] . "'" : '';
		$link_class = isset( $arr['link_class']{1} ) ? "class='" . $arr['link_class'] . "'" : '';
		$text = '<li ' . $el_cllas . '> <a ' . $link_class . ' href="' . $item->href . '"> ' . $item->text . ' </a> ' . "\r\n";;

		return $text;

	}


	public function end_el( $level ) {

		$n = "\n";

		return "</li>{$n}";

	}
}