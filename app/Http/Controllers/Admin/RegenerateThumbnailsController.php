<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Medias;
use Gate;
use Cache;
use Illuminate\Http\Request;
use Image;
use Response;

class RegenerateThumbnailsController extends AdminController {


	public function __construct() {
		parent::__construct();

		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index( Request $request ) {
		//


		if ( !Gate::allows( 'MEDIAS.VIEW' ) ) {
			return back()->withErrors([__('You don\'t have access to this')]);
			abort( 403 );
		}



		if ( $request->ajax() && $request->ajax_load_page ) {
			$medias = Medias::all();
			$arr_id = [];
			foreach ( $medias as $media ) {
				$arr_id[]['id'] = $media->id;
			}
			return Response::json( $arr_id, 200 );

		}


		$thumbnail_sizes = $this->baseCms->getImagesSize();
		$media = Medias::all()->count();
		$this->title = __('admin.Regenerate Thumbnails');

		$content = $this->getTemplate( 'medias.regenerateThumbnails', compact( 'thumbnail_sizes', 'media' ) );
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
	public function store( Request $request ) {
		//
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

		if ( !Gate::allows( 'REGENERATE_THUMBNAILS' ) ) {
			return back()->withErrors([__('You don\'t have access to this')]);
			abort( 403 );
		}


		$arr = [];

		$media = Medias::where( 'id', $id )->first();
		$image_sizes = json_decode( $media->image_sizes );



		$registredSizes = $this->baseCms->getImagesSize();


		// whe check old sizes and if it not exits we deleted it and file
		foreach ( $image_sizes as $k => $v ) {
			if ( isset( $registredSizes[$k] ) && ( $registredSizes[$k]['width'] == $v->width ) && ( $registredSizes[$k]['height'] == $v->height ) ) {
				unset( $registredSizes[$k] );

			} else {
				// delete file
				unlink(  public_path(). $media->directory .   DIRECTORY_SEPARATOR . $v->file);
				unset( $image_sizes->$k );

			}
		}



		$object = new \stdClass();
		$dir = public_path() . $media->directory;
		// regenerate new thumbnails
		foreach ( $registredSizes as $k => $v ) {
			$image = public_path() . DIRECTORY_SEPARATOR . $media->path;
			$new_file_name = str_replace( '.' . $media->mime_type, '', $media->filename );
			$new_file_name = $new_file_name . '-' . $v['width'] . 'x' . $v['height'] . '.' . $media->mime_type;
			//echo  $new_file_name;


			$v['file'] = $new_file_name;
			$arr[$k] = $v;
			if ( !empty( $name ) ) {
				$object->$name = arrayToObject( $v );
			}



			$img = Image::make( $image );
			$height = $img->height();
			$width = $img->width();


			if ( $height < $v['height'] || $width < $v['width'] ) {
				$img->resize( $v['width'], $v['height'], function ( $constraint ) {
					$constraint->aspectRatio();
				}, 'top' )->save( $dir . '' . $new_file_name );
			} else {

				$img->fit( $v['width'], $v['height'], function ( $constraint ) {
					$constraint->aspectRatio();
				}, 'top' )->save( $dir . '' . $new_file_name );

			}
		}



		foreach ( $image_sizes as $k => $v ) {
			$arr[$k] = [
				'width' => $v->width,
				'height' => $v->height,
				'file' => $v->file,
			];
		}
		$media->image_sizes = json_encode( $arr );
		$media->update();
		Cache::forget('the_image_url_'.$media->id);

		return Response::json( ['message' => 'Regenerated ' .$media->filename], 200 );



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
