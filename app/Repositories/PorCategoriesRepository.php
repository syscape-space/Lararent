<?php

namespace Corp\Repositories;

use App;
use Config;
use Corp\Category;
use Corp\PorCategory;
use Corp\Portfolio;
use Corp\Post;
use Gate;
use Image;

class PorCategoriesRepository extends Repository {


	public function __construct( PorCategory $porCategory ) {
		$this->model = $porCategory;
	}

	public function addCategory( $request ) {

		if ( Gate::denies( 'save', $this->model ) ) {
			abort( 403 );
		}


		$data = $request->except( '_token' );


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
			'parent_id' => $request->parent_id ?? 0,
			'description' => $request->description ?? '',


		];

		$this->model->fill( $data_translate );

		if ( $this->model->save() ) {
			return [ 'status' => __( 'admin.Category added' ), 'id' => $this->model->id ];
		} else {
			return [ 'error' => __( 'admin.error' ) ];
		}
	}

	public function updateCategory( $request, $id ) {
		$category = $this->model->where( 'id', $id )->first();

		$data = $request->except( '_token' );


		if ( empty( $data ) ) {
			return array( 'error' => __( 'admin.not-have-dates' ) );
		}

		if ( empty( $data['alias'] ) ) {
			$data['alias'] = $this->transliterate( $data['title'] );
		} else {
			$data['alias'] = $this->transliterate( $data['alias'] );
		}
		$data['keywords'] = $request->keywords ?? '';



		$data_translate = [
			'code' => App::getLocale(),
			App::getLocale() => $data,
			'alias' => $data['alias'],
			'parent_id' => $request->parent_id ?? 0,
			'description' => $request->description ?? '',


		];




		$category->fill( $data_translate );

		if ( $category->update() ) {
			return [ 'status' => __( 'admin.Category updated' ), 'id' => $category->id ];
		} else {
			return [ 'error' => __( 'admin.error' ) ];
		}
	}



	public function deleteCategory( $category ) {

		$post = new Portfolio();
		$post->porCategories()->detach($category->id);

		if ( $category->delete() ) {
			echo 1;
			return [ 'status' => __( 'admin.Category deleted' ) ];
		}
		echo 2;

	}


}

