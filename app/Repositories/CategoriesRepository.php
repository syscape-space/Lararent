<?php

namespace Corp\Repositories;

use App;
use Config;
use Corp\Category;
use Corp\Post;
use Gate;
use Image;

class CategoriesRepository extends Repository {


	public function __construct( Category $posts ) {
		$this->model = $posts;
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


		/*	if ( $this->one( $data['alias'], FALSE ) ) {
				$request->merge( array( 'alias' => $data['alias'] ) );
				$request->flash();

				return [ 'error' => 'Данный псевдоним уже успользуется' ];
			}
	*/

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

	public function transliterateAll( $categories ) {

		//$categories->load('translations');

		//$categories->load('translations');
		if ( ( method_exists( $categories, 'translate' ) ) ) {
			$categories_t = $categories->translate( App::getlocale(), true );


			if ( $categories_t ) {
				foreach ( $categories_t->getAttributes() as $k => $v ) {

					if ( $k != 'id' ) {
						$categories->$k = $v;
					}
				}
			}
		}

		return $categories;
	}

	public function transliterateAll2( $categories ) {

		//$categories->load('translations');

		//$categories->load('translations');
		if ( ( method_exists( $categories, 'translate' ) ) ) {
			$categories_t = $categories->translate( App::getlocale(), true );


			if ( $categories_t ) {
				foreach ( $categories_t->getAttributes() as $k => $v ) {

					if ( $k != 'id' ) {
						$categories->$k = $v;
					}
				}
			}
		}

		return $categories;
	}

	public function buildAddForm() {


	}

	public function deleteCategory( $category ) {

		$post = new Post();
		$post->categories()->detach($category->id);

		if ( $category->delete() ) {
			return [ 'status' => __( 'admin.Category deleted' ) ];
		}

	}


}

