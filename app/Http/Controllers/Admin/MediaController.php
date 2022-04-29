<?php

namespace Corp\Http\Controllers\Admin;


use Cache;
use Corp\Medias;
use Gate;
use Illuminate\Http\Request;
use Image;
use MediaUploader;
use Response;

class MediaController extends AdminController {

	public function __construct() {

		parent::__construct();


		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index( Request $request ) {
		//

		if ( !Gate::allows( 'MEDIAS.VIEW' ) ) {
			return back()->withErrors( [ __( 'You don\'t have access' ) ] );
			abort_unless( Gate::allows( 'MEDIAS.CREATE' ), 403 );
		}

		if ( $request->ajax() && $request->ajax_load_page ) {

			return $this->getMedias();
		}


		$this->title = __( 'admin.Media library' );

		$content = $this->getTemplate( 'media', [
			'medias' => $this->getMedias()
		] );


		$this->vars = array_add( $this->vars, 'content', $content );


		return $this->renderOutput();

	}

	public
	function getMedias() {

		$medias = Medias::orderBy( 'created_at', 'desc' )->paginate( 24 );

		$content = '';
		foreach ( $medias as $media ) {
			$content .= view( 'admins.' . config( 'settings.admin' ) . '.medias.media-loop' )
				->with( [ 'media' => $media ] )->render();
		}


		return $content;

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public
	function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public
	function store(
		Request $request
	) {


		abort_unless( Gate::allows( 'MEDIAS.CREATE' ), 403 );

		if ( $request->hasFile( 'file' ) ) {
			$image = $request->file( 'file' );


			if ( $image->isValid() ) {

				$dir = public_path() . '/uploads/' . date( 'Y/m/d', time() ) . '/';

				// check if $folder is a directory

				if ( !\File::isDirectory( $dir ) ) {

					$f = \File::makeDirectory( $dir, 0777, true );

				}

				$original_name = trim( str_replace( ' ', '-', $image->getClientOriginalName() ) );

				$path = $dir . $image->getClientOriginalName();
				$str = str_random( 8 );


				$img_big = Image::make( $image );

				$img_big->save( $path );

				$media = new Medias();
				$data = [
					'path' => '/uploads/' . date( 'Y/m/d', time() ) . '/' . $image->getClientOriginalName(),
					'directory' => '/uploads/' . date( 'Y/m/d', time() ) . '/',
					'filename' => $original_name,
					'mime_type' => $image->getClientOriginalExtension(),
					'aggregate_type' => 'image',
					'size' => $image->getSize(),


				];
				$media->fill( $data );

				$object = new \stdClass();
				$arr = [];


				foreach ( $this->baseCms->getImagesSize() as $k => $v ) {

					$new_file_name = str_replace( '.' . $image->getClientOriginalExtension(), '', $original_name );
					$new_file_name = $new_file_name . '-' . $v['width'] . 'x' . $v['height'] . '.' . $image->getClientOriginalExtension();
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


				$media->image_sizes = json_encode( $arr );


				if ( $media->save() ) {


					if ( isset( $request->tiny_uploader ) ) {
						return json_encode( [ 'location' => url( $media->path ) ] );

					} else {
						return view( 'admins.' . config( 'settings.admin' ) . '.medias.media-loop' )
							->with( [ 'media' => $media ] )->render();
					}


				}


			}


		}


	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public
	function show(
		$id
	) {
		//

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public
	function edit(
		$id
	) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public
	function update(
		Request $request, $id
	) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public
	function destroy(
		$id
	) {
		abort_unless( Gate::allows( 'MEDIAS.DELETE' ), 403 );

		//
		$response = [];

		$media = Medias::where( 'id', $id )->first();
		$image_sizes = json_decode( $media->image_sizes );


		foreach ( $image_sizes as $v ) {
			if ( isset( $v->file ) && is_file( public_path( $media->directory . '' . $v->file ) ) ) {
				unlink( public_path( $media->directory . '' . $v->file ) );
			}
		}

		if ( is_file( public_path( $media->directory . $media->filename ) ) && unlink( public_path( $media->directory . $media->filename ) ) ) {
			$response['file'] = 'deleted';

		}
		if ( $media->delete() ) {
			$response['bd'] = 'deleted';
			return Response::json( $response );
		}
		return Response::json( $response );

	}


	public
	function mediaPopup() {

		$content = $this->getTemplate( 'medias.modal', [
			'medias' => $this->getMedias()
		] );


		return $content;

	}


}
