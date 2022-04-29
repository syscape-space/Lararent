<?php

namespace Corp\Repositories;

use App;
use Config;
use Corp\Post;
use Corp\Tag;
use Gate;
use Image;

class PostsRepository extends Repository {


	public function __construct( Post $posts ) {
		$this->model = $posts;
	}

	public function one( $alias, $attr = array() ) {
		$post = parent::one( $alias, $attr );

		if ( $post && !empty( $attr ) ) {
			$post->load( 'comments' );
			$post->comments->load( 'user' );
		}

		return $post;
	}

	public function addPost( $request ) {

		/*if(Gate::denies('save', $this->model)) {
			abort(403);
		}
		*/

		$data = $request->except( '_token', 'image' );
		$data['img'] = $data['img'] ?? '';
		$data['keywords'] = $data['keywords'] ?? '';

		if ( empty( $data ) ) {
			return array( 'error' => __('admin.not-have-dates') );
		}

		if ( empty( $data['alias'] ) ) {
			$data['alias'] = $this->transliterate( $data['title'] );
		} else {
			$data['alias'] = $this->transliterate( $data['alias'] );
		}


		if ( $this->one( $data['alias'], FALSE ) ) {
			$request->merge( array( 'alias' => $data['alias'] ) );
			$request->flash();

			return [ 'error' =>  __('admin.alias-used')  ];
		}


		$data_translate = [
			'code' => App::getLocale(),
			'status' => $data['status'] ?? 'published',

			App::getLocale() => $data,
			'alias' => $data['alias'],
			'img' => $data['img'],
			'published_at' => new \DateTime()

		];


		$this->model->fill( $data_translate );



		if ($post = $request->user()->posts()->save( $this->model ) ) {
			$post->categories()->sync( $request->category_id );


			return [ 'status' => __( 'admin.post added' ),'id'=>$post->id ];
		} else {
			return [ 'error' => __( 'admin.error' ) ];
		}
	}

	public function updatePost( $request, $post ) {

		/*if ( Gate::denies( 'edit', $this->model ) ) {
			abort( 403 );
		}
*/


		$data = $request->except( '_token', '_method' );

		if ( empty( $data ) ) {
			return array( 'error' => __( 'admin.not-have-dates' ) );
		}

		if ( empty( $data['alias'] ) ) {
			$data['alias'] = $this->transliterate( $data['title'] );
		}
		if ( empty( $data['img'] ) ) {
			$data['img'] = '';
		}
		if ( empty( $data['keywords'] ) ) {
			$data['keywords'] = '';
		}

		$result = $this->one( $data['alias'], FALSE );

		if ( isset( $result->id ) && ( $result->id != $post->id ) ) {
			$request->merge( array( 'alias' => $data['alias'] ) );
			$request->flash();

			return [ 'error' => __( 'admin.alias-used' ) ];
		}


		$data_translate = [
			'code' => App::getLocale(),
			App::getLocale() => $data,
			'alias' => $data['alias'],
			'img' => $data['img'],
			'status' => $data['status'] ?? '',

		];
		if ( isset( $request->published_at ) ) {
			$unix_date = strtotime( $request->published_at );
			$published_at = date( 'Y-m-d H:i:s', $unix_date );
			$data_translate['published_at'] = $published_at;
		}


		// dd( $data_translate);
		$post->fill( $data_translate );
		$post->categories()->sync( $request->category_id );




		if ( $request->tags ) {

			$tags = explode( ',', $request->tags );

			$tags_id = null;
			foreach ( $tags as $tag ) {

				$t = Tag::where( 'alias', $this->transliterate( $tag ) )->first();
				if ( $t ) {
					$tags_id[] = $t->id;
				} // tags not exits we added new
				else {

					$new_tag = new Tag(  [
						'code' => App::getLocale(),
						App::getLocale() => [
							'title' => $tag,
							'keywords' => '',
							'description' => '',

						],
						'alias' => $this->transliterate( $tag ),
						'description' => '',


					] );


					if ( $new_tag->save() ) {
						$tags_id[] = $new_tag->id;

					}
				}
			}

			$post->tags()->sync( $tags_id );
		//	dd( $tags_id );
		}
		//dd( $post);
		//$post->fill( $data );

		if ( $post->update() ) {

			return [ 'status' => __( 'admin.post-updated' ) ];
		}

	}


	public function deletePost( $post ) {

		if ( Gate::denies( 'destroy', $post ) ) {
			abort( 403 );
		}
		$post->meta()->delete();
		$post->comments()->delete();
	//	$post->tags()->delete();

		if ( $post->delete() ) {
			return [ 'status' => __( 'admin.post-deleted' ) ];
		}

	}

}

?>