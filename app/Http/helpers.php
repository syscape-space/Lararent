<?php


function lr_is_installed() {
	$is = config( 'lararent.is_installed' );


	return (bool) $is;
}

function lr_parse_args( $args, $defaults = '' ) {
	if ( is_object( $args ) ) {
		$r = get_object_vars( $args );
	} elseif ( is_array( $args ) ) {
		$r =& $args;
	} else {
		lr_parse_str( $args, $r );
	}

	if ( is_array( $defaults ) ) {
		return array_merge( $defaults, $r );
	}
	return $r;
}

function lr_parse_str( $string, &$array ) {
	parse_str( $string, $array );
	if ( get_magic_quotes_gpc() ) {
		$array = stripslashes_deep( $array );
	}
	/**
	 * Filters the array of variables derived from a parsed string.
	 *
	 * @since 2.3.0
	 *
	 * @param array $array The array populated with variables.
	 */

}

function stripslashes_deep( $value ) {
	return map_deep( $value, 'stripslashes_from_strings_only' );

}

function map_deep( $value, $callback ) {
	if ( is_array( $value ) ) {
		foreach ( $value as $index => $item ) {
			$value[$index] = map_deep( $item, $callback );
		}
	} elseif ( is_object( $value ) ) {
		$object_vars = get_object_vars( $value );
		foreach ( $object_vars as $property_name => $property_value ) {
			$value->$property_name = map_deep( $property_value, $callback );
		}
	} else {
		$value = call_user_func( $callback, $value );
	}

	return $value;
}

/**
 * @param $media
 * @param bool $size
 * @return string
 */
function the_image_url( $media, $size = false ) {
	//dd('the_image_url_' . $media);
	if ( !is_object( $media ) ) {
		$media = Cache::remember( 'the_image_url_' . $media, 1000, function () use ( $media ) {
			return \Corp\Medias::where( 'id', $media )->first();
		} );
	}


	if ( isset( $media->image_sizes ) ) {
		$image_sizes = json_decode( $media->image_sizes );
	}


	if ( $size != false ) {
		if ( isset( $image_sizes->$size ) && isset( $image_sizes->$size->file ) ) {

			return url( $media->directory . $image_sizes->$size->file );
		}
	}
	if ( isset( $media->path ) ) {
		return url( $media->path );
	}

}


/**
 * generate Tree with children items
 * @param array $elements
 * @param int $parentId
 * @return array
 */
function buildTree( array $elements, int $parentId = 0 ) {
	$branch = array();


	foreach ( $elements as $element ) {
		if ( !isset( $element['parent_id'] ) ) {

			foreach ( $element as $item ) {
				if ( $item['parent_id'] == $parentId ) {
					$children = buildTree( $elements, $item['id'] );
					if ( $children ) {
						$item['children'] = $children;
					}
					$branch[] = $item;
				}
			}
		} else {
			if ( $element['parent_id'] == $parentId ) {
				$children = buildTree( $elements, $element['id'] );
				if ( $children ) {
					$element['children'] = $children;
				}
				$branch[] = $element;
			}
		}
	}

	return $branch;
}


/**
 * @param $items
 * @return array
 */
function sortDeps( $items ) {
	$res = array();
	$doneList = array();

	//dd($items);
	// while not all items are resolved:
	while ( count( $items ) > count( $res ) ) {
		$doneSomething = false;

		foreach ( $items as $itemIndex => $item ) {
			if ( !isset( $item['name'] ) ) {


				continue;
			}
			if ( isset( $item['name'] ) && isset( $doneList[$item['name']] ) ) {
				// item already in resultset
				continue;
			}
			$resolved = true;

			if ( isset( $item['deps'] ) ) {
				foreach ( $item['deps'] as $dep ) {
					if ( !isset( $items[$dep] ) ) {
						continue;
					}
					if ( !isset( $doneList[$dep] ) ) {
						// there is a dependency that is not met:
						$resolved = false;
						break;
					}
				}
			}
			if ( $resolved ) {
				//all dependencies are met:
				$doneList[$item['name']] = true;
				$res[$item['name']] = $item;
				$doneSomething = true;
			}
		}
		if ( !$doneSomething ) {
			echo 'unresolvable dependency';
		}
	}
	return $res;
}


/**
 * @param array $tree
 * @param null $category_id
 * @param int $Level
 * @param int $prev_id
 * @return string
 */
function buildSelectOptions( array $tree, $category_id = null, int $Level = 0, $prev_id = 0 ) {

	$text = '';
	foreach ( $tree as $k => $item ) {
		$Level = $item['parent_id'] != 0 ? $Level : 0;

		$title = isset( $item['title'] ) ? $item['title'] : $item['alias'];
		if ( $prev_id['parent_id'] == 0 ) {
			$Level = 1;
		}


		$selected = '';
		if ( $category_id != null && $category_id == $item['id'] ) {
			$selected = 'selected ';
		}


		if ( $item['parent_id'] != 0 ) {
			$text .= ' <option class="level-' . $Level .
			         '" value="' . $item['id'] . '" ' . $selected . ' >' .
			         str_repeat( '&nbsp;', $Level ) . '' . $title . '</option>' . "\n\r";
		} else {
			$text .= ' <option class="level-' . $Level .
			         '" value="' . $item['id'] . '" ' . $selected . ' >' . $title . '</option>' . "\n\r";
		}

		//$Level = 0;
		if ( isset( $item['children'] ) ) {
			$text .= buildSelectOptions( $item['children'], $category_id, ++ $Level, $item );

		}


	}
	return $text;

}

/**
 * @param array $tree
 * @param null $category_id
 * @param int $Level
 * @param int $prev_id
 * @param string $name
 * @return string
 */
function buildUlCheckboxOptions( array $tree, $category_id = null, int $Level = 0, $prev_id = 0, $name = 'category_id' ) {

	$text = '<ul class="category-group icheck-list">';
	foreach ( $tree as $k => $item ) {
		$Level = $item['parent_id'] != 0 ? $Level : 0;

		$title = isset( $item['title'] ) ? $item['title'] : $item['alias'];
		if ( $prev_id['parent_id'] == 0 ) {
			$Level = 1;
		}


		$selected = '';
		if ( $category_id != null && in_array( $item['id'], $category_id ) ) {
			$selected = 'checked ';
		}


		if ( $item['parent_id'] != 0 ) {
			$text .= '<li class="category-item"><label> <input name="' . $name . '[]" data-checkbox="icheckbox_square-red" type="checkbox"  class=" check  level-' . $Level .
			         '" value="' . $item['id'] . '" ' . $selected . ' >'
			         . $title . '' . "</label>\n\r";
		} else {
			$text .= ' <li class="category-item"> <label> <input name="' . $name . '[]" data-checkbox="icheckbox_square-red"  type="checkbox"  class="check level-' . $Level .
			         '" value="' . $item['id'] . '" ' . $selected . ' >' . $title . '</label>' . "\n\r";
		}

		//$Level = 0;
		if ( isset( $item['children'] ) ) {
			$text .= buildUlCheckboxOptions( $item['children'], $category_id, ++ $Level, $item );

		}

		$text .= "</li>";

	}
	return $text . '</ul>';

}


/**
 * helpers functions for checkbox
 * @param $current_vale
 * @param $checked_value
 */
function checked( $current_vale, $checked_value ) {
	if ( $current_vale == $checked_value ) {
		echo 'checked';
	}

}

/**
 * @param $current_vale
 * @param $checked_value
 */
function selected( $current_vale, $checked_value ) {
	if ( $current_vale == $checked_value ) {
		echo 'selected';
	}

}

/**
 * @param $name
 * @param null $arr
 * @return bool|string
 * @throws Throwable
 */
function getAdminTemplate( $name, $arr = null ) {
	if ( !View::exists( 'admins.' . config( 'settings.admin' ) . '.' . $name ) ) {
		return false;
	}
	if ( is_array( $arr ) ) {
		return view( 'admins.' . config( 'settings.admin' ) . '.' . $name )
			->with( $arr )
			->render();
	} else {
		return view( 'admins.' . config( 'settings.admin' ) . '.' . $name )
			->render();
	}
}

function setFrontendJs( $name, $path = '', $deps = array(), $ver = false, $in_footer = true, $priority = 20, $object_name = false, $obj = [] ) {
	return app()->make( 'BaseCms' )->setFrontendJs( $name, $path, $deps, $ver, $in_footer, $priority, $object_name, $obj );

}


function get_theme_mod( $key, $default_value = false ) {
	if ( isset( $_GET['lr_preview_customize'] ) && $_GET['lr_preview_customize'] ) {

		if ( !isset( $_SESSION ) ) {
			session_start();
		}
		$sesion = $_SESSION['lr_theme_options'] ?? '';
		if ( !empty( $sesion ) ) {

			return $sesion[$key] ?? false;
		} else {
			$res = false;
			config( 'themeoptions.' . session( 'lr_active_theme_slug' ) . '_' . \Corp\Http\Middleware\LocaleMiddleware::getLocale() . '.' . $key, false );
			return config( 'themeoptions.' . session( 'lr_active_theme_slug' ) . '.' . $key, $default_value );

		}
	} else {
		$res = false;
		$res = config( 'themeoptions.' . session( 'lr_active_theme_slug' ) . '_' . \Corp\Http\Middleware\LocaleMiddleware::getLocale() . '.' . $key, false );
		if ( $res ) {


			return $res;
		}
		if ( !headers_sent() ) {
			if ( session_status() === PHP_SESSION_NONE ) {
				session_start();
			}
		}
		$session = $_SESSION["lr_active_theme_slug"] ?? session( 'lr_active_theme_slug' );


		return config( 'themeoptions.' . $session . '.' . $key, $default_value );
	}
}


function getOption( $option, $default = null ) {
	if ( !lr_is_installed() ) {
		return;
	}
	$desired_object = app( 'BaseCms' )->options->filter( function ( $item ) use ( $option ) {
		return $item->name == $option;
	} )->first();

	$res = $desired_object;


	if ( isset( $res->value ) ) {
		if ( isJson( $res->value ) ) {
			$default = json_decode( $res->value );
		} else {
			$default = $res->value;
		}
	}
	return $default;

}

/**
 * @return array
 */
function getlangsCodes() {
	$langs = getOption( 'custom_langs' );
	$res = [];
	if ( isset( $langs->code ) && isset( $langs->name ) ) {

		foreach ( $langs->code as $k => $v ) {
			$res[] = $v;
		}

	}
	return $res;
}


function isJson( $string ) {
	json_decode( $string );
	return ( json_last_error() == JSON_ERROR_NONE );
}


function formatted_price( $price ) {
	return str_replace( '&nbsp;', ' ', ec_price( $price ) );

//	return $price . ' $';
}


function rentit_DateDiff( $interval, $date1, $date2 ) {
	// get seconds
	$timedifference = $date2 - $date1;

	switch ( $interval ) {
		case 'w':
			$retval = ceil( $timedifference / 604800 );
			break;
		case 'd':
			$retval = ceil( $timedifference / 86400 );
			break;
		case 'h':
			$retval = ceil( $timedifference / 3600 );
			break;
		case 'n':
			$retval = bcdiv( $timedifference, 60 );
			break;
		case 's':
			$retval = $timedifference;
			break;

	}

	return $retval;

}

/**
 * @param $product
 * @return array
 */
function getProductMetas( $product ) {
	$meta = $product->meta;
	$product_meta = [];
	foreach ( $meta as $item ) {
		if ( $item->value == '' ) {
			$product_meta[$item->name] = $item->translation_value;

		} else {
			$product_meta[$item->name] = $item->value;
		}
	}


	return $product_meta;
}

/**
 * @param $item
 * @return array
 */
function getMetas( $item ) {
	return getProductMetas( $item );
}

/**
 * Return formatted price
 * @param $price
 * @param array $args
 * @return string
 */
function ec_price( $price, $args = [] ) {

	$settings = Cache::remember( 'ecommerce_currency_options', 1000000, function () {
		$settings = \Corp\Option::where( 'name', 'ecommerce_currency_options' )->first();
		return isset( $settings->translation_value{1} ) ? unserialize( $settings->translation_value ) : [];
	} );

	$currency_pos = $settings['currency_pos'] ?? '';
	$format = '%1$s%2$s';

	switch ( $currency_pos ) {
		case 'left':
			$format = '%1$s%2$s';
			break;
		case 'right':
			$format = '%2$s%1$s';
			break;
		case 'left_space':
			$format = '%1$s&nbsp;%2$s';
			break;
		case 'right_space':
			$format = '%2$s&nbsp;%1$s';
			break;
	}


	$args = lr_parse_args(
		$args, array(
			'ex_tax_label' => false,
			'currency' => $settings['currency'] ?? '',
			'decimal_separator' => $settings['price_decimal_sep'] ?? '',
			'thousand_separator' => $settings['price_thousand_sep'] ?? '',
			'decimals' => $settings['price_num_decimals'] ?? '',
			'price_format' => $format,


		)

	);

	$unformatted_price = $price;

	$negative = $price < 0;
	$price = floatval( $negative ? $price * - 1 : $price );
	$price =
		number_format(
			$price, $args['decimals'],
			$args['decimal_separator'],
			$args['thousand_separator'] );

	if ( $args['decimals'] > 0 ) {
		$price = preg_replace( '/' . preg_quote( $settings['price_decimal_sep'] ?? '', '/' ) . '0++$/', '', $price );

	}

	$formatted_price = ( $negative ? '-' : '' ) . sprintf( $args['price_format'],
			$args['currency'], $price );

	/**
	 * Filters the string of price markup.
	 *
	 * @param string $return Price HTML markup.
	 * @param string $price Formatted price.
	 * @param array $args Pass on the args.
	 * @param float $unformatted_price Price as float to allow plugins custom formatting. Since 3.2.0.
	 */
	return $formatted_price;
}

function getCurrencyCode() {
	$settings = Cache::remember( 'ecommerce_currency_options', 1000000, function () {
		$settings = \Corp\Option::where( 'name', 'ecommerce_currency_options' )->first();
		return isset( $settings->translation_value{1} ) ? unserialize( $settings->translation_value ) : [];
	} );
	return $settings['currency_code'] ?? false;

}

function getControllerTitle( $controller ) {
	$params = getOption( 'seo_title', '%controller_title% > %site_title%' );
	$params = str_replace( [ '%controller_title%', '%site_title%' ], [
		$controller,
		getOption( 'blogname' )
	], $params );

	return $params;
}


function isAdminBarVisible() {

	if ( !auth()->user() ) {
		return false;
	}
	try {
		return (bool) auth()->user()->isSuperAdmin();
	} catch ( \Exception $e ) {
		return false;
	}
}


function str_replace_last2( $search, $replace, $str ) {
	if ( ( $pos = strrpos( $str, $search ) ) !== false ) {
		$search_length = strlen( $search );
		$str = substr_replace( $str, $replace, $pos, $search_length );
	}
	return $str;
}


function get_locations_from_slug( $slug ) {
	return Cache::rememberForever( 'location_' . $slug, function () use ( $slug ) {
		$location = \Corp\Plugins\eCommerce\Models\Location::where( 'alias', $slug )->first();
		if ( isset( $location->title ) ) {
			return $location->title;
		} else {
			return false;
		}
	} );

}

function random_color_part() {
	return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT );
}

function random_color() {
	return random_color_part() . random_color_part() . random_color_part();
}


function inArray( $find, $arr ) {
	foreach ( $arr as $item ) {
		if ( $item == $find ) {
			return true;
		}
	}
	return false;
}