<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 19.06.2018
 * Time: 22:06
 */

namespace Corp\Plugins\eCommerce;

use App;
use Artisan;
use Auth;
use Corp\Http\Controllers\Admin\BackendMenu;
use Corp\Http\Middleware\LocaleMiddleware;
use Corp\Plugins\eCommerce\Models\Location;
use Corp\Plugins\eCommerce\Models\Order;
use Corp\Plugins\eCommerce\Models\Product;
use Corp\Plugins\eCommerce\Policies\LocationPolicy;
use Corp\Plugins\eCommerce\Policies\ProductPolicy;
use DB;
use Eventy;
use Gate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Lang;
use V\Plugins\Plugin;

class eCommercePlugin extends Plugin {


	// namespace  like folder name
	public $name = 'eCommerce';
	public $backendMenu;
	private $order_rep;

	public function __construct( Application $app ) {
		parent::__construct( $app );
		$this->user = Auth::user();
		$this->baseCms = app()->make( 'BaseCms' );


	}

	/**
	 * Boot plugin
	 */
	public function boot() {

		// TODO: Implement boot() method.

		$this->enableRoutes();
		$this->enableViews();
		$this->registerPolicy();
		$this->addWidgetsToAdminArea();

		// add new relations

		\Illuminate\Database\Eloquent\Builder::macro( 'location', function () {
			return $this->getModel( User::class )->hasMany( Location::class );
		} );
		\Illuminate\Database\Eloquent\Builder::macro( 'products', function () {
			return $this->getModel( User::class )->hasMany( Product::class );
		} );


		$this->baseCms->addBackendMenu(
			[

				'name' => __( 'Products' ) . Lang::locale()
        ,
				'label' => '',
				'url' => route( 'admin.products.index' ),
				'icon' => 'fa fa-car',
				'permissions' =>  'product.view' ,
				'order' => 4,
				'sideMenu' => [
					[
						'name' => __( 'Products' ),
						'url' => route( 'admin.products.index' ),
						'permissions' =>  ['product.view']
					],

					[
						'name' => __( 'Add Product' ),
						'url' => route( 'admin.products.create' ),
						'permissions' => 'product.view'
					],
					[
						'name' => __( 'Categories' ),
						'url' => route( 'admin.products.categories.index' ),
						'permissions' => [ 'VIEW_PRODUCT_CATEGORY' ]
					],
					[
						'name' => __( 'Group' ),
						'url' => route( 'admin.products.categories.index', [ 'group' => true ] ),
						'permissions' => [ 'categories.create' ]
					],


				]


			]
		);

		$this->baseCms->addBackendMenu(

			[

				'name' => __( 'eCommerce' ),
				'label' => '',
				'url' => route( 'admin.products.orders.index' ),
				'icon' => 'icon-basket fa-fw',
				'permissions' => 'VIEW_ECOMMERCE',
				'order' => 4,
				'sideMenu' => [
					[
						'name' => __( 'Orders' ),
						'url' => route( 'admin.products.orders.index' ),
						'permissions' => [ 'VIEW_ECOMMERCE' ]
					],
					[
						'name' => __( 'Settings' ),
						'url' => route( 'admin.ecommerce.settings.index' ),
						'permissions' => [ 'VIEW_ECOMMERCE' ]
					],
					[
						'name' => __( 'Coupons' ),
						'url' => route( 'admin.ecommerce.coupons.index', [ 'group' => true ] ),
						'permissions' => [ 'VIEW_ECOMMERCE' ]
					],

				]


			]


		);
		$this->baseCms->addBackendMenu(
			[

				'name' => __( 'Locations' ),
				'label' => '',
				'url' => route( 'admin.locations.index' ),
				'icon' => 'fa fa-map-marker',
				'permissions' => [ 'VIEW_LOCATION' ],
				'order' => 4,


			]
		);
		$this->baseCms->addBackendMenu(
			[

				'name' => __( 'Reports' ),
				'label' => '',
				'url' => route( 'adminReports' ),
				'icon' => 'fa  fa-line-chart',
				'permissions' => [ 'VIEW_REPORTS' ],
				'order' => 4,


			]
		);


	}


	/**
	 * add new list permission to roles
	 * @return array
	 */
	public function permission() {
		// TODO: Implement permission() method.

		return [
			'product.viewAll',
			'product.view',
			'product.create',
			'product.update',
			'product.delete',
		];
	}

	/**
	 * Register new policy
	 */
	public function registerPolicy() {

		\Gate::policy( Product::class, ProductPolicy::class );
		\Gate::policy( Location::class, LocationPolicy::class );

		Gate::define( 'product.viewAll', function ( $user ) {
			return $user->canDo( 'product.viewAll' );
		} );
	}

	/**
	 * On activate we run migration
	 */
	public function onActivate() {
		Artisan::call( 'migrate', [
			'--path' => '/app/Plugins/eCommerce/Migrations'
		] );
	}


	public function addWidgetsToAdminArea() {

		if ( isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/admin' ) {
			return false;
		}
		Eventy::addAction( 'dashboard.top-widget', function () {

			$b = DB::select( 'SELECT COUNT(*) as counts FROM `ec_orders`' );
			$b_c = DB::select( 'SELECT COUNT(*) as counts FROM `ec_orders` where  status = "completed"' );
			$b_p = DB::select( 'SELECT COUNT(*) as counts FROM `ec_orders` where  status = "pending"' );
			$b_price = DB::select( 'SELECT SUM(price) as counts FROM `ec_order_items` ' );


			$pricePerThisMonth = DB::select( '  SELECT SUM(price) as counts
 FROM `ec_order_items` WHERE DATEDIFF(NOW(),created_at ) <= DAY(LAST_DAY(NOW()))
 ' );


			?>

            <div class="row">
                <div class="col-md-4">
                    <div class="white-box ecom-stat-widget">
                        <div class="row">
                            <div class="col-xs-6">
                                <span class="text-blue font-light"><?php echo $b[0]->counts ?? '0' ?> <i
                                            class="icon-arrow-up-circle text-success"></i></span>
                                <p class="font-12"><?php echo __( 'Bookings' ); ?></p>
                            </div>
                            <div class="col-xs-6">
                                <span class="icoleaf bg-primary text-white"><i
                                            class="mdi mdi-checkbox-marked-circle-outline"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="white-box ecom-stat-widget">
                        <div class="row">
                            <div class="col-xs-6">
                                <span class="text-blue font-light"><?php echo $b_c[0]->counts ?? '0' ?><i
                                            class="icon-arrow-down-circle text-danger"></i></span>
                                <p class="font-12"><?php echo __( "Completed Orders" ) ?></p>
                            </div>
                            <div class="col-xs-6">
                                <span class="icoleaf bg-success text-white"><i class="mdi mdi-comment-text-outline"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="white-box ecom-stat-widget">
                        <div class="row">
                            <div class="col-xs-9">
                                <span class="text-blue font-light"><?php echo formatted_price( $b_price[0]->counts ?? 0 ); ?>
                                    <i class="icon-arrow-up-circle text-success"></i></span>
                                <p class="font-12"><?php echo __( "Total Earnings" ); ?></p>
                            </div>
                            <div class="col-xs-3">
                                <span class="icoleaf bg-danger text-white"><i class="mdi mdi-coin"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

			<?php
		} );

		Eventy::addAction( 'dashboard.icon-header', function () {

			$orders = DB::select( '  SELECT *
 FROM `ec_orders` WHERE DATEDIFF(NOW(),created_at ) <= DAY(LAST_DAY(NOW()))
   ORDER BY created_at DESC LIMIT 5

 ' );


			?>

            <li>
                <div class="drop-title"><?php echo __( 'You have new Orders' ) ?></div>
            </li>

            <li>
                <div class="message-center">
					<?php foreach ( $orders as $order ) { ?>
                        <a href="<?php echo route( 'admin.products.orders.edit', [ 'order' => $order->id ] ); ?>">
                            <div class="mail-contnet">
                                <h5><?php echo $order->name ?? '' ?></h5>
                                <span class="mail-desc"><?php echo $order->street_address ?? '' ?></span>
                                <span class="time"><?php echo $order->created_at ?></span>
                            </div>
                        </a>
					<?php } ?>
                </div>
            </li>
			<?php
		} );

		Eventy::addAction( 'dashboard.bottom-widget', function () {
			$b = DB::select( 'SELECT COUNT(*) as counts FROM `ec_orders`' );
			$b_c = DB::select( 'SELECT COUNT(*) as counts FROM `ec_orders` where  status = "completed"' );
			$b_p = DB::select( 'SELECT COUNT(*) as counts FROM `ec_orders` where  status = "pending"' );

			$order = new Order();

			$salesInThisMonth = ( $order->getSalesDaysInCurrentMonth() );


			$days = implode( ',', array_pluck( $salesInThisMonth, 'day' ) );
			$sum = implode( ',', array_pluck( $salesInThisMonth, 'price' ) );

			?>
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="white-box stat-widget">
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <h4 class="box-title"><?php echo __( "Sales Statistics in current month" ) ?></h4>
                            </div>
                            <div class="col-md-9 col-sm-9">

                                <ul class="list-inline">

                                    <li>
                                        <h6 class="font-15"><i class="fa fa-circle m-r-5 text-primary"></i><?php echo __('Orders Sum'); ?>
                                        </h6>
                                    </li>
                                </ul>
                            </div>

                            <div class="stat chart-pos"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="white-box order-chart-widget">
                        <h4 class="box-title"><?php echo __( "Order Status" ) ?></h4>
                        <div id="order-status-chart" style="height: 250px;"></div>
                        <ul class="list-inline m-b-0 m-t-20 t-a-c">
                            <li>
                                <h6 class="font-15"><i
                                            class="fa fa-circle m-r-5 text-primary"></i><?php echo __( "Orders" ) ?>
                                </h6>
                            </li>
                            <li>
                                <h6 class="font-15"><i
                                            class="fa fa-circle m-r-5 text-danger"></i><?php echo __( "Pending" ) ?>
                                </h6>
                            </li>
                            <li>
                                <h6 class="font-15"><i
                                            class="fa fa-circle m-r-5 text-success"></i><?php echo __( "Completed" ) ?>
                                </h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <script>
                $(function () {

                    var chart1 = new Chartist.Line('.stat', {
                        labels: [<?php echo $days; ?>],
                        series: [

                            [<?php echo $sum; ?>]
                        ]
                    }, {

                        low: 0,
                        height: '278px',
                        showArea: false,
                        fullWidth: true,
                        axisY: {
                            onlyInteger: true,
                            showGrid: false,
                            offset: 50,
                        },
                        plugins: [
                            Chartist.plugins.tooltip()
                        ]
                    });
                    var chart = [chart1];

                    for (var i = 0; i < chart.length; i++) {
                        chart[i].on('draw', function (data) {
                            if (data.type === 'line' || data.type === 'area') {
                                data.element.animate({
                                    d: {
                                        begin: 500 * data.index,
                                        dur: 500,
                                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                                        to: data.path.clone().stringify(),
                                        easing: Chartist.Svg.Easing.easeInOutElastic
                                    }
                                });
                            }
                            if (data.type === 'bar') {
                                data.element.animate({
                                    y2: {
                                        dur: 500,
                                        from: data.y1,
                                        to: data.y2,
                                        easing: Chartist.Svg.Easing.easeInOutElastic
                                    },
                                    opacity: {
                                        dur: 500,
                                        from: 0,
                                        to: 1,
                                        easing: Chartist.Svg.Easing.easeInOutElastic
                                    }
                                });
                            }
                        });
                    }


                    Morris.Donut({
                        element: 'order-status-chart',
                        data: [{
                            label: "<?php  echo __( 'Total Orders' );  ?>",
                            value: <?php echo $b[0]->counts ?? 0; ?>

                        }, {
                            label: "<?php  echo __( 'Pending Orders' );  ?>",
                            value: <?php echo $b_p[0]->counts ?? 0; ?>
                        }, {
                            label: "<?php  echo __( 'Completed Orders' );  ?>",
                            value:  <?php echo $b_c[0]->counts ?? 0; ?>
                        }],
                        resize: true,
                        colors: ['#0283cc', '#e74a25', '#2ecc71']
                    });
                });
            </script>
			<?php

		} );

	}
}



