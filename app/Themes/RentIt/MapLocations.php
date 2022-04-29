<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 18.09.2018
 * Time: 12:53
 */

namespace Corp\Themes\RentIt;


use Corp\Plugins\eCommerce\Models\Product;

class MapLocations {
	protected $product;

	public function __construct( Product $product ) {
		$this->product = $product;
	}

	public function generateObject() {
		ob_start();
		try {
			$products_obj = $this->product->with( 'translations', 'meta', 'meta.translations' )->whereNotNull( 'published_at' )
			                              ->where( 'published_at', '<', new \DateTime() )
			                              ->latest( 'created_at' )
			                              ->whereHas( 'meta', function ( $query ) {
				                              $query->where( 'name', 'rentit_lat_long' )
				                                    ->where( 'value', '>', '0' );

			                              } )
			                              ->get();


			?>
            {
            'all': [

			<?php if ( $products_obj ) {
				foreach ( $products_obj as $item ) {
					try {
						$product_meta = getProductMetas( $item );


						$latLng = explode( ',', $product_meta['rentit_lat_long'] );


						$product_icons = unserialize( $product_meta['product_icons'] );


						$icons = [];

						if ( is_array( $product_icons ) && $product_icons['icon'] ?? false && $product_icons['text'] ?? false ) {
							$product_icons = array_combine( $product_icons['icon'], $product_icons['text'] );

							$j = 0;
							foreach ( $product_icons as $k => $v ) {
								if ( $j < 3 ) {
									$icons[$k] = $v;
//							    $icons[] = [
//								    'icon' => $k,
//								    'text' => $v
//							    ];
								}

								$j ++;
							}


							$icons = json_encode( $icons );


						}


						?>
                        {
                        name: '<?php echo e( str_replace( "\n", ' ', $item->title ) );
						?>',
                        location_latitude: <?php echo $latLng[0]; ?>,
                        location_longitude:  <?php echo $latLng[1]; ?>,
                        map_image_url: '<?php echo the_image_url( $item->img, 'thumbnail-270x220' ) ?>',
                        name_point: '<?php echo e( str_replace( "\n", ' ', $item->title ) ); ?>',
                        fa_icon: '/rentit/img/icon-google-map.png',

                        description_point: '',
                        icons: '<?php if(is_array($icons)){ } else { echo $icons;} ?>',
                        url_point: '<?php echo route( 'products.show', [ 'products' => $item->alias ] ) ?>',
                        transmission: 'Auto',
                        engine: 'Diesel',
                        year:'2015',
                        moreinfo: '<?php echo __( 'Rent It' ); ?>',

                        },
						<?php
					} catch ( \Exception $e ) {

					}
				}
			} ?>


            ]

			<?php
		} catch (\Exception $e){

		}
		return ob_get_clean();
	}
}