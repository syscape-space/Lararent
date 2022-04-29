<?php

namespace Corp\Repositories;

use App;
use Config;
use Corp\Page;
use Gate;
use Image;

/**
 * Class PageRepository
 * @package Corp\Repositories
 */
class PageRepository extends Repository {


	/**
	 * PageRepository constructor.
	 * @param Page $pages
	 */
	public function __construct( Page $pages ) {
		$this->model = $pages;
	}


	/** Get page by alias
	 * @param $alias
	 * @param array $attr
	 * @return mixed
	 */
	public function one( $alias, $attr = array() ) {
		$page = parent::one( $alias, $attr );
		return $page;
	}

	/** Add ne page to DB
	 * @param $request
	 * @return array
	 */
	public function addPage( $request ) {

		$data = $request->except( '_token', 'image' );
		$data['img'] = $data['img'] ?? '';
		$data['keywords'] = $data['keywords'] ?? '';
		$data['text'] = $request->text ?? '';

		if ( empty( $data ) ) {
			return array( 'error' => __( 'admin.not-have-dates' ) );
		}

		if ( empty( $data['alias'] ) ) {
			$data['alias'] = $this->transliterate( $data['title'] );
		} else {
			$data['alias'] = $this->transliterate( $data['alias'] );
		}


		if ( $this->one( $data['alias'], FALSE ) ) {
			$request->merge( array( 'alias' => $data['alias'] ) );
			$request->flash();

			return [ 'error' => __( 'admin.alias-used' ) ];
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


		if ( $page = $request->user()->page()->save( $this->model ) ) {
			$this->setMeta($request, $page);

			return [ 'status' => __( 'admin.page added' ), 'id' => $page->id ];
		} else {
			return [ 'error' => __( 'admin.error' ) ];
		}
	}

	/**
	 * update Page
	 * @param $request
	 * @param $page
	 * @return array
	 */
	public function updatePage( $request, $page ) {


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
		$data['text'] = $request->text ?? '';
		$result = $this->one( $data['alias'], FALSE );

		if ( isset( $result->id ) && ( $result->id != $page->id ) ) {
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


		$page->fill( $data_translate );


		if ( $page->update() ) {
			$this->setMeta($request, $page);
			return [ 'status' => __( 'admin.page-updated' ), 'id' => $page->id  ];
		}

	}


	/**
	 * @param $page
	 * @return array
	 */
	public function deletePage( $page ) {

		if ( Gate::denies( 'destroy', $page ) ) {
			abort( 403 );
		}
		$page->module()->delete();
		if ( $page->delete() ) {
			return [ 'status' => __( 'admin.page-deleted' ) ];
		}


	}

	/**
	 * @param $request
	 * @param $product
	 */
	public function setMeta( $request, $product ) {

		if ( $request->rentit_disable_footer ) {

			$product->meta()->updateOrCreate( [
				'name' => 'rentit_disable_footer',
			], [ 'value' => $request->rentit_disable_footer ] )->save();

		} else {
			 $product->meta()->updateOrCreate( [
				'name' => 'rentit_disable_footer',
			], [ 'value' => false])->save();
		}

	}



}
