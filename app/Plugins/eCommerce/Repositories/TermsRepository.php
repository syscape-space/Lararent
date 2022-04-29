<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15.08.2018
 * Time: 17:10
 */

namespace Corp\Plugins\eCommerce\Repositories;





use Corp\Plugins\eCommerce\Models\Term;
use Corp\Repositories\Repository;
use App;

class TermsRepository  extends Repository {
	public function __construct( Term $product ) {
		$this->model = $product;
	}


	public  function  addCategory($request){
		$data = $request->except( '_token' );
		$data['description'] = $request->description ?? '';


		if ( empty( $data ) ) {
			return array( 'error' => __('admin.not-have-dates') );
		}

		if ( empty( $data['alias'] ) ) {
			$data['alias'] = $this->transliterate( $data['title'] );
		} else {
			$data['alias'] = $this->transliterate( $data['alias'] );
		}
		$data['keywords'] = $request->keywords ?? '';

		if ( $this->one( $data['alias'], FALSE ) ) {
			$request->merge( array( 'alias' => $data['alias'] ) );
			$request->flash();

			return [ 'error' => __('admin.alias-used') ];
		}


		$data_translate = [
			'code' => App::getLocale(),
			App::getLocale() => $data,
			'alias' => $data['alias'],
			'type' =>  $request->type,
			'parent_id' => $request->parent_id ?? 0,



		];


		$this->model->fill( $data_translate );

		if ( $this->model->save() ) {
			if($request->type == 'group')
				return [ 'status' => __( 'admin.Group added' ), 'id' => $this->model->id ];

			return [ 'status' => __( 'admin.Category added' ), 'id' => $this->model->id ];
		} else {
			return [ 'error' => __( 'admin.error' ) ];
		}
	}

	public function updateCategory($request, $id){


		$category = $this->model->where( 'id', $id )->first();


		$data = $request->except( '_token' );
		$data['description'] = $request->description ?? '';


		if ( empty( $data ) ) {
			return array( 'error' => __('admin.not-have-dates') );
		}

		if ( empty( $data['alias'] ) ) {
			$data['alias'] = $this->transliterate( $data['title'] );
		} else {
			$data['alias'] = $this->transliterate( $data['alias'] );
		}



		$data['keywords'] = $request->keywords ?? '';


		if ( $this->one( $data['alias'], FALSE )->id != $id ) {
			$request->merge( array( 'alias' => $data['alias'] ) );
			$request->flash();

			return [ 'error' => __('admin.alias-used') ];
		}


		$data_translate = [
			'code' => App::getLocale(),
			App::getLocale() => $data,
			'alias' => $data['alias'],
			'type' =>  $request->type,
			'parent_id' => $request->parent_id ?? 0,



		];



		$category->fill( $data_translate );

		if ( $category->update() ) {
			if($request->type == 'group')
				return [ 'status' => __( 'admin.Group updated' ), 'id' => $this->model->id ];

			return [ 'status' => __( 'admin.Category updated' ), 'id' => $this->model->id ];
		} else {
			return [ 'error' => __( 'admin.error' ) ];
		}
	}

	public function deleteCategory( $category ) {

		//$post = new Post();
	//	$post->categories()->detach($category->id);

		if ( $category->delete() ) {
			return [ 'status' => __( 'admin.Category deleted' ) ];
		}

	}


}