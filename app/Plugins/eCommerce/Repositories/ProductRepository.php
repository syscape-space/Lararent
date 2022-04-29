<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 14.08.2018
 * Time: 13:13
 */

namespace Corp\Plugins\eCommerce\Repositories;


use App;
use Corp\Plugins\eCommerce\Models\Booking;
use DB;
use Corp\Plugins\eCommerce\Models\Product;
use Corp\Plugins\eCommerce\Models\Season;
use Corp\Repositories\Repository;
use function GuzzleHttp\Psr7\str;

class ProductRepository extends Repository {
	public function __construct( Product $product ) {
		$this->model = $product;
	}

	public function addProduct( $request ) {

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
			'price' => $request->price ?? 0,
			'published_at' => new \DateTime()

		];



		$this->model->fill( $data_translate );




		if ( $product = $request->user()->products()->save( $this->model ) ) {
			$this->setMeta( $request, $product );
			$product->terms()->sync( $request->category_id );
			return [ 'status' => __( 'admin.Product added' ),'id' => $product->id ];
		} else {
			return [ 'error' => __( 'admin.error' ) ];
		}
	}


	public function updateProduct( $request, $product ) {


		$data = $request->only( 'title', 'alias', 'price', 'desc', 'text', 'img', 'meta_desc', 'keywords', 'status' );;
		if ( empty( $data ) ) {
			return array( 'error' => __( 'admin.not-have-dates' ) );
		}

		if ( empty( $data['alias'] ) ) {
			$data['alias'] = $this->transliterate( $data['title'] );
		} else {
			$data['alias'] = $this->transliterate( $data['alias'] );
		}
		if ( empty( $data['img'] ) ) {
			$data['img'] = '';
		}
		if ( empty( $data['keywords'] ) ) {
			$data['keywords'] = '';
		}

		$result = $this->one( $data['alias'], FALSE );

		if ( isset( $result->id ) && ( $result->id != $product->id ) ) {
			$request->merge( array( 'alias' => $data['alias'] ) );
			$request->flash();

			return [ 'error' => __( 'admin.alias-used' ) ];
		}


		$data_translate = [
			'code' => App::getLocale(),
			App::getLocale() => $data,
			'alias' => $data['alias'],
			'img' => $data['img'],
			'status' => $data['status'] ?? 'published',
			'price' => $request->price ?? 0,


		];
		if ( isset( $request->published_at ) ) {
			$unix_date = strtotime( $request->published_at );
			$published_at = date( 'Y-m-d H:i:s', $unix_date );
			$data_translate['published_at'] = $published_at;
		}


		$product->fill( $data_translate );

		// set terms
		$product->terms()->sync( $request->category_id );


		if ( $product->update() ) {


			$this->setMeta( $request, $product );

			return [ 'status' => __( 'admin.Product updated' ) ];
		}
	}

	public function deleteProduct($product){

		$product->meta()->delete();

		if ( $product->delete() ) {
			return [ 'status' => __( 'admin.post-deleted' ) ];
		}

	}

	/**
	 * @param $request
	 * @param $product
	 */
	public function setMeta( $request, $product ) {
		// set gallery media

		if ( $request->gallery_media ) {

			$item = $product->meta()->updateOrCreate( [
				'name' => 'gallery_media',
			], [ 'value' => $request->gallery_media ] );

			//$item->save();

		}
		if ( $request->rentit_deposit_percent ) {

			 $product->meta()->updateOrCreate( [
				'name' => 'rentit_deposit_percent',
			], [ 'value' => $request->rentit_deposit_percent ] );

			//$item->save();

		}
		// set gallery

		if ( $request->attributes ) {


			$product->meta()->updateOrCreate( [
				'name' => 'attributes',
			],
				[
					'code' => App::getLocale(),
					'value' => '',
					App::getLocale() =>
						[ 'translation_value' => json_encode( $request->get( 'attributes' ) ) ],
				]
			);


			//$item->save();

		}

		// translation_value

		if ( $request->_rental_resource_ ) {


			$product->meta()->updateOrCreate( [
				'name' => '_rental_resource',
			],
				[
					'code' => App::getLocale(),
					'value' => '',
					App::getLocale() =>
						[ 'translation_value' => json_encode( $request->_rental_resource_ ) ],
				]
			);
		}


		if ( $request->__picking_up_location ) {

			$item = $product->meta()->updateOrCreate( [
				'name' => '__picking_up_location',
			], [ 'value' => json_encode( $request->__picking_up_location ) ] );
			$item->save();

		} else {
			$item = $product->meta()->updateOrCreate( [
				'name' => '__picking_up_location',
			], [ 'value' => '']);
			$item->save();
		}
		if ( $request->__dropping_off_location ) {

			$item = $product->meta()->updateOrCreate( [
				'name' => '__dropping_off_location',
			], [ 'value' => json_encode( $request->__dropping_off_location ) ] );
			$item->save();

		}else {
			$item = $product->meta()->updateOrCreate( [
				'name' => '__dropping_off_location',
			], [ 'value' => '']);
			$item->save();
		}



		// lat long


		if ( $request->rentit_lat_long ) {

			$item = $product->meta()->updateOrCreate( [
				'name' => 'rentit_lat_long',
			], [ 'value' => $request->rentit_lat_long ] );
			$item->save();

		} else {

			$item = $product->meta()->updateOrCreate( [
				'name' => 'rentit_lat_long',
			], [ 'value' => '' ] );
			$item->save();
		}

		// formatted

		if ( $request->rentit_formatted_address ) {

			$item = $product->meta()->updateOrCreate( [
				'name' => 'rentit_formatted_address',
			], [ 'value' => $request->rentit_formatted_address ] );
			$item->save();

		} else {

			$item = $product->meta()->updateOrCreate( [
				'name' => 'rentit_formatted_address',
			], [ 'value' => '' ] );
			$item->save();
		}
		if ( $request->product_stars ) {

			$item = $product->meta()->updateOrCreate( [
				'name' => 'product_stars',
			], [ 'value' => $request->product_stars ] );
			$item->save();

		} else {

			$item = $product->meta()->updateOrCreate( [
				'name' => 'product_stars',
			], [ 'value' => 5 ] );
			$item->save();
		}

		/**
		 * Save product icons
		 */
		if ( $request->product_icons ) {


			$product->meta()->updateOrCreate( [
				'name' => 'product_icons',
			],
				[
					'code' => App::getLocale(),
					'value' => '',
					App::getLocale() =>
						[ 'translation_value' => serialize( $request->product_icons ) ],
				]
			);
		} else {
			$product->meta()->updateOrCreate( [
				'name' => 'product_icons',
			],
				[
					'code' => App::getLocale(),
					'value' => '',
					App::getLocale() =>
						[ 'translation_value' => '' ],
				]
			);
		}

		/*
		 * Season price
		 */

		$product->Season()->delete();
		if(isset($request->_rental_season_price)){
			$seasons = array();

			$season_start_date = isset( $_POST['_rental_season_start_date'] ) ? $_POST['_rental_season_start_date'] : array();
			$season_end_date = isset( $_POST['_rental_season_end_date'] ) ? $_POST['_rental_season_end_date'] : array();
			$season_price = isset( $_POST['_rental_season_price'] ) ? $_POST['_rental_season_price'] : array();
			$rental_season_discount = isset( $_POST['_rental_season_discount'] ) ? $_POST['_rental_season_discount'] : array();

			foreach ( $season_start_date as $key => $value ) {

				$val_lc = strtolower( $value );
				$slug = str_replace( " ", "-", $val_lc );

				/*$seasons[] = array(
					'price' => ( $season_price[$key] ),
					'start_date' => ( $season_start_date[$key] ),
					'end_date' => ( $season_end_date[$key] ),
					'rental_season_discount' => $rental_season_discount[$key]

				);*/
				if(isset($rental_season_discount[$key]['cost'])){
					foreach ($rental_season_discount[$key]['cost']  as $k=> $item){



						$season = new Season;
//						$season->fill([
//							[
//								'base_price' => $season_price[$key] ?? '',
//								'startDate' => strtotime($season_start_date[$key]),
//								'endDate' => strtotime($season_end_date[$key]),
//								'cost' => $item,
//								'type' => $rental_season_discount[$key]['duration_type'][$k] ?? '',
//								'Duration' => $rental_season_discount[$key]['duration_val'][$k] ?? '',
//							]
//						]);
						$season->base_price =  $season_price[$key] ;
						$season->startDate =  strtotime($season_start_date[$key]) ;
						$season->endDate =  strtotime($season_end_date[$key]) ;
						$season->cost =  $item ;
						$season->type =  $rental_season_discount[$key]['duration_type'][$k] ?? 'days' ;
						$season->Duration =  $rental_season_discount[$key]['duration_val'][$k] ;
//						dump($season);
//						dump([
//							'base_price' => (float)$season_price[$key] ?? '',
//							'startDate' => strtotime($season_start_date[$key]),
//							'endDate' => strtotime($season_end_date[$key]),
//							'cost' => (float)$item,
//							'type' => $rental_season_discount[$key]['duration_type'][$k] ?? '',
//							'Duration' => $rental_season_discount[$key]['duration_val'][$k] ?? '',
//						]);
						$product->Season()->save($season);
					}

				}


			}


		}

//		dd($request->all());





	}



	/**
	 * Get products and filter products by request
	 * @param $request
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null
	 */
	public function getProducts( $request , $term_alias, $product_per_page = false) {

		try {


			$catalog_orderby = get_theme_mod( 'rentit_catalog_orderby', 'price' );
			/**
			 * If this term
			 */
			if($term_alias){
				$products_obj = Product::whereRaw( "id in(
			SELECT etp.product_id
FROM ec_terms_product AS etp
LEFT JOIN ec_terms AS et ON etp.term_id = et.id
WHERE   et.alias = ?)
			", [ $term_alias ] );
			} else {
				/**
				 * This is all products
				 */

				// filter by categories and group
				if ( ( $request->group ?? false ) || ( $request->category ?? false ) ) {
					if ( $request->group ?? false ) {
						session( [ 'group' => $request->group ] );
					}
					if ( $request->category ?? false ) {
						session( [ 'category' => $request->category ] );
						$_SESSION['category'] = $request->category;
					}


					if ( isset( $request->group{2} ) && isset( $request->category{2} ) ) {

						$products_obj = Product::whereRaw( "id in(
			SELECT etp.product_id
FROM ec_terms_product etp JOIN
     ec_terms et
     ON etp.term_id = et.id
WHERE et.alias IN (?, ?)
GROUP BY etp.product_id
HAVING COUNT(*) = 2)
			", [ $request->category, $request->group ] )->

						with( 'translations', 'meta', 'meta.translations' )->whereNotNull( 'published_at' )
						                       ->where( 'published_at', '<', new \DateTime() );

					} elseif ( $request->group ) {


						$products_obj = Product::whereRaw( "id in(
			SELECT etp.product_id
FROM ec_terms_product AS etp
LEFT JOIN ec_terms AS et ON etp.term_id = et.id
WHERE `et`.`type` = 'group' and  et.alias = ?)
			", [ $request->group ] );

					} elseif ( $request->category ) {
						$products_obj = Product::whereRaw( "id in(
			SELECT etp.product_id       
FROM ec_terms_product AS etp
LEFT JOIN ec_terms AS et ON etp.term_id = et.id
WHERE `et`.`type` = 'category' and  et.alias = ?)
			", [ $request->category ] )->

						with( 'translations', 'meta', 'meta.translations' )->whereNotNull( 'published_at' )
						                       ->where( 'published_at', '<', new \DateTime() );


					}


				} else {


					$products_obj = Product::with( 'translations', 'meta', 'meta.translations' )->whereNotNull( 'published_at' )
					                       ->where( 'published_at', '<', new \DateTime() );
				}


				if ( isset( $_GET ) ) {


					$PickingUpLocation = $request->PickingUpLocation ?? null;
					$DroppingOffLocation = $request->DroppingOffLocation ?? null;

					if ( $PickingUpLocation ) {
						$products_obj = $products_obj->whereHas( 'meta', function ( $query ) use ( $PickingUpLocation ) {
							$query->where( 'name', '__picking_up_location' )
							      ->where( 'value', 'like', '%' . $PickingUpLocation . '%' );

						} );
						session( [ 'PickingUpLocation' => $request->PickingUpLocation ] );
						$_SESSION['PickingUpLocation'] = $request->PickingUpLocation;
					}

					if ( $DroppingOffLocation ) {
						$products_obj = $products_obj->whereHas( 'meta', function ( $query ) use ( $DroppingOffLocation ) {
							$query->where( 'name', '__dropping_off_location' )
							      ->where( 'value', 'like', '%' . $DroppingOffLocation . '%' );


						} );
						session( [ 'DroppingOffLocation' => $request->DroppingOffLocation ] );
						$_SESSION['DroppingOffLocation'] = $request->DroppingOffLocation;
					}

					if ( isset( $request->price_filter ) && $request->price_filter ) {
						$priceRange = explode( ',', $request->price_filter );

						if ( isset( $priceRange[0] ) && isset( $priceRange[1] ) ) {
							$products_obj = $products_obj->where( 'price', '>=', $priceRange[0] )->where( 'price', '<=', $priceRange[1] );
						}

					}

				}


				//
				if ( isset( $request->PickingUpDate ) && isset( $request->DroppingOffDate ) ) {
					$star_date = strtotime( $request->PickingUpDate . ' ' . $request->PickingUpHour );
					$end_date = strtotime( $request->DroppingOffDate . ' ' . $request->DroppingOffHour );

					$_SESSION['star_date'] = $star_date;
					$_SESSION['end_date'] = $end_date;
					$days = rentit_DateDiff( 'd', ( $star_date ), ( $end_date ) );

					// find reserved products
					$bookings = Booking::select( 'product_id','status' )
					                   ->where( 'PickingUpDate', '<=', $star_date )
					                   ->where( 'DroppingOffDate', '>=', $star_date )
					                   ->where( 'status',  'completed' )
						->rightJoin('ec_orders', 'ec_bookings.order_id', '=', 'ec_orders.id')
						               ->get();
					$exclude_id = [];


					foreach ( $bookings as $booking ) {
						$exclude_id[] = $booking->product_id;
					}
					$exclude_id = array_unique( $exclude_id );


					if ( $exclude_id ) {
						$products_obj->where( 'id', '!=', $exclude_id );
					}


					$products_obj->select( 'ec_products.*' )->
					leftJoin( DB::raw( '
				 
				 (
				 
				 SELECT ec_season.cost,
ec_season.base_price,
ec_season.product_id
FROM ec_season
WHERE 
 ec_season.startDate <= \'' . (int) $star_date . '\' and ec_season.endDate >= \'' . (int) $end_date . '\'
 and  ec_season.Duration = (
  SELECT MAX(s2.Duration)
FROM ec_season s2
WHERE 
 s2.startDate <= \'' . (int) $star_date . '\' and s2.endDate >= \'' . (int) $end_date . '\'
 and  s2.Duration <=  ' . (int) $days . '  AND
s2.product_id = ec_season.product_id )


		
		)
		
				 
				 AS t1', [ 'days' => $days ] ), 't1.product_id', '=', 'ec_products.id' )
					             ->select( '*',
						             DB::raw( "COALESCE(t1.cost, t1.base_price, `ec_products`.`price`) AS final_cost" ) );


					if ( $catalog_orderby == 'price' ) {
						$products_obj->orderBy( 'final_cost', 'ASC' );
					} elseif ( $catalog_orderby == 'price-desc' ) {
						$products_obj->orderBy( 'final_cost', 'DESC' );
					} elseif ( 'date' ) {
						$products_obj->latest( 'ec_products.created_at' );
					}


				} else {

					$products_obj->select( 'ec_products.*' )->
					leftJoin( DB::raw( '
				 
				 (
				 
				 SELECT ec_season.cost,
ec_season.base_price,
ec_season.product_id
FROM ec_season
WHERE 
 ec_season.startDate <= \'' . (int) time() . '\' and ec_season.endDate >= \'' . (int) time() . '\'
 and  ec_season.Duration = (
  SELECT MAX(s2.Duration)
FROM ec_season s2
WHERE 
 s2.startDate <= \'' . (int) time() . '\' and s2.endDate >= \'' . (int) time() . '\'
 and  s2.Duration <=  1  AND
s2.product_id = ec_season.product_id )


		
		)
		
				 
				 AS t1' ), 't1.product_id', '=', 'ec_products.id' )
					             ->select( '*',
						             DB::raw( "COALESCE(t1.cost, t1.base_price, `ec_products`.`price`) AS final_cost" ) );


					if ( $catalog_orderby == 'price' ) {
						$products_obj->orderBy( 'final_cost', 'ASC' );
					} elseif ( $catalog_orderby == 'price-desc' ) {
						$products_obj->orderBy( 'final_cost', 'DESC' );
					} elseif ( 'date' ) {
						$products_obj->latest( 'ec_products.created_at' );
					}
					if ( $catalog_orderby == 'price' ) {
						$products_obj->orderBy( 'price', 'ASC' );
					} elseif ( $catalog_orderby == 'price-desc' ) {
						$products_obj->orderBy( 'price', 'DESC' );
					} elseif ( 'date' ) {
						$products_obj->latest( 'ec_products.created_at' );
					}
				}


			}

			$products = $products_obj->paginate(  $product_per_page ? $product_per_page : get_theme_mod( 'rentit_product_display', 6 ) );

			// for pagination
			$products->appends( request()->query() );
			/*
		 * save date to session
		 */

			if ( isset( $request->PickingUpDate ) ) {
				session( [ 'PickingUpDate' => $request->PickingUpDate ] );

			}
			if ( isset( $request->DroppingOffDate ) ) {
				session( [ 'DroppingOffDate' => $request->DroppingOffDate ] );

			}


			if ( isset( $request->PickingUpHour ) ) {
				session( [ 'PickingUpHour' => $request->PickingUpHour ] );
			}
			if ( isset( $request->DroppingOffHour ) ) {
				session( [ 'DroppingOffHour' => $request->DroppingOffHour ] );
			}

			return $products;
		} catch ( \Exception $e ) {
			return null;
		}


	}
}