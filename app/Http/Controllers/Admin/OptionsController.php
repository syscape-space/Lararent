<?php

namespace Corp\Http\Controllers\Admin;

use Gate;
use Corp\Http\Requests\OptionRequest;
use Corp\Option;
use Illuminate\Http\Request;

class OptionsController extends AdminController {

	public function __construct() {
		parent::__construct();
		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index( Option $option ) {
		//
		if ( !Gate::allows( 'VIEW_OPTIONS' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}
		$this->title = __('admin.Options');


        $dir = resource_path().'/lang';
		$available_langs = array_diff( scandir( $dir ), array( '..', '.' ) );
		foreach ( $available_langs as $k => $item ) {
			if ( preg_match( '#\.#', $item ) ) {

				unset( $available_langs[$k] );
			}
		}


		$langs = [
			"fr" => "French - français",
			"en" => "English",
			"ar" => "Arabic - العربية",
			"ja" => "Japanese - 日本語",
			"es" => "Spanish - Español",
			"de" => "German - Deutsch",
			"it" => "Italian - Italiano",
			"id" => "Indonesian - Bahasa Indonesia",
			"pt" => "Portuguese - Português",
			"ko" => "Korean - 한국어",
			"tr" => "Turkish - Türkçe",
			"ru" => "Russian - Русский",
			"nl" => "Dutch - Nederlands",
			"fil" => "Filipino - Filipino",
			"msa" => "Malay - Bahasa Melayu",
			"zh-tw" => "Traditional Chinese - 繁體中文",
			"zh-cn" => "Simplified Chinese - 简体中文",
			"hi" => "Hindi - हिन्दी",
			"no" => "Norwegian - Norsk",
			"sv" => "Swedish - Svenska",
			"fi" => "Finnish - Suomi",
			"da" => "Danish - Dansk",
			"pl" => "Polish - Polski",
			"hu" => "Hungarian - Magyar",
			"fa" => "Farsi - فارسی",
			"he" => "Hebrew - עִבְרִית",
			"ur" => "Urdu - اردو",
			"th" => "Thai - ภาษาไทย"
		];


		//$langs = array_combine($langs, $custom_langs );


		$all_options = Option::with( 'translations' )->get();
		$options = [];
		foreach ( $all_options as $k => $v ) {
			$options[$v->name] = $v->value;
		}

		$custom_langs = json_decode( $options['custom_langs'] ?? '' );
		if ( isset( $custom_langs->code ) && isset( $custom_langs->name ) ) {
			$custom_langs = array_combine( $custom_langs->code, $custom_langs->name );
		}


		if ( is_array( $custom_langs ) ) {
			$langs = array_merge( $langs, $custom_langs );
		}


		$content = $this->getTemplate( '.options.all',
			compact( 'options', 'available_langs', 'langs','custom_langs' ) );

		$this->vars = array_add( $this->vars, 'content', $content );
		return $this->renderOutput();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( OptionRequest $request, Option $option ) {
		//
		if ( !Gate::allows( 'EDIT_OPTIONS' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access to do this' ) ] );
			abort( 403 );

		}

		$data = $request->except( '_', '_token' );

		foreach ( $data as $k => $v ) {

			if ( $v == null ) {
				continue;
			}

			$item = $option::updateOrCreate( [
				'name' => $k,
			], [ 'value' => is_array( $v ) ? json_encode( $v ) : $v ] );
			$item->save();
			if ( $item ) {
				$result = [ 'status' => __( 'admin.option-updated' ) ];;
			}

		}


		if ( is_array( $result ) && !empty( $result['error'] ) ) {

			return back()->with( $result );
		}

		return back()->with( $result );

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
	}
}
