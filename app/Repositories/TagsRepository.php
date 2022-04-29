<?php

namespace Corp\Repositories;

use App;
use Config;
use Corp\Category;
use Corp\Post;
use Corp\Tag;
use Gate;

class TagsRepository extends Repository {


	public function __construct( Tag $Tag ) {
		$this->model = $Tag;
	}

	public function addTag( $request ) {

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
			'description' => $request->description ?? '',


		];

		$this->model->fill( $data_translate );

		if ( $this->model->save() ) {
			return [ 'status' => __( 'admin.Tag added' ), 'id' => $this->model->id ];
		} else {
			return [ 'error' => __( 'admin.error' ) ];
		}
	}

	public function updateTag( $request, $id ) {
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

			'description' => $request->description ?? '',


		];


		$category->fill( $data_translate );

		if ( $category->update() ) {
			return [ 'status' => __( 'admin.Tag updated' ), 'id' => $category->id ];
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



	public function deleteTag( $tag ) {


		$tag = $this->model->where('id',$tag)->first();
		$post = new Post();
		$post->tags()->detach($tag->id);

		if ( $tag->delete() ) {
			return [ 'status' => __( 'admin.Tag deleted' ) ];
		}

	}


}

