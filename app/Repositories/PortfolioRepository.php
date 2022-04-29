<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 16.10.2018
 * Time: 12:53
 */

namespace Corp\Repositories;


use App;
use Gate;
use Cache;


use Corp\Portfolio;
class PortfolioRepository extends Repository {

	public function __construct( Portfolio $portfolios ) {
		$this->model = $portfolios;
	}

	public function one( $alias, $attr = array() ) {
		$portfolio = parent::one( $alias, $attr );

		if ( $portfolio && !empty( $attr ) ) {
			$portfolio->load( 'comments' );
			$portfolio->comments->load( 'user' );
		}

		return $portfolio;
	}

	public function addPortfolio( $request ) {


		/*if(Gate::denies('save', $this->model)) {
			abort(403);
		}
		*/

		$data = $request->except( '_token', 'image' );
		$data['img'] = $data['img'] ?? '';
		$data['keywords'] = $data['keywords'] ?? '';

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


		if ( $portfolio = $request->user()->portfolios()->save( $this->model ) ) {
			$portfolio->porCategories()->sync( $request->category_id );

			$this->setMeta( $request, $portfolio );


			return [ 'status' => __( 'admin.portfolio added' ), 'id' => $portfolio->id ];
		} else {
			return [ 'error' => __( 'admin.error' ) ];
		}
	}

	public function updatePortfolio( $request, $portfolio ) {

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
		$data['alias'] = $this->transliterate( $data['alias'] );
		if ( empty( $data['img'] ) ) {
			$data['img'] = '';
		}
		if ( empty( $data['keywords'] ) ) {
			$data['keywords'] = '';
		}

		$result = $this->one( $data['alias'], FALSE );

		if ( isset( $result->id ) && ( $result->id != $portfolio->id ) ) {
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
		$portfolio->fill( $data_translate );
		$portfolio->porCategories()->sync( $request->category_id );


		//$portfolio->fill( $data );

		if ( $portfolio->update() ) {
			$this->setMeta( $request, $portfolio );
			Cache::forget('portfolio_content' . $portfolio->alias);
			return [ 'status' => __( 'admin.portfolio-updated ' ) ];
		}

	}


	/**
	 * @param $portfolio
	 * @return array
	 */
	public function deletePortfolio( $portfolio ) {

		if ( Gate::denies( 'destroy', $portfolio ) ) {
			abort( 403 );
		}
		$portfolio->meta()->delete();

		if ( $portfolio->delete() ) {
			return [ 'status' => __( 'admin.portfolio-deleted' ) ];
		}

	}

	/**
	 * @param $request
	 * @param $portfolios
	 */
	public function setMeta( $request, $portfolio ) {
		if ( $request->gallery_media ) {

			$item = $portfolio->meta()->updateOrCreate( [
				'name' => 'gallery_media',
			], [ 'value' => $request->gallery_media ] );


		}
	}
}