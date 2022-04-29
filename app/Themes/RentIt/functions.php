<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.08.2018
 * Time: 20:41
 */


function rentit_get_times() {
	$value = get_theme_mod( 'rent_it_options_time' );
	$new_arr = [];
	if ( isset( $value['hour'] ) && isset( $value['minute'] ) && isset( $value['format'] ) ) {


		foreach ( $value['hour'] as $k => $item ) {
			$value['minute'][$k] = ( $value['minute'][$k] < 10 && strlen( $value['minute'][$k] ) == 1 ) ? '0' . $value['minute'][$k] : $value['minute'][$k];
			$new_arr[] =
				$item . ':' . $value['minute'][$k] . ' ' . $value['format'][$k] ?? '';
		}
	}
	return $new_arr;
}
