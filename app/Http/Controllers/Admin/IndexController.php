<?php

namespace Corp\Http\Controllers\Admin;


use Auth;
use Corp\User;
use Eventy;
use Gate;

class IndexController extends AdminController {
	//
	public function __construct() {

		parent::__construct();

		$this->baseCms->setAdminCss( 'morris', asset( config( 'settings.admin' ) . '/plugins/components/morrisjs/morris.css' ), array( 'jquery' ), '1', false, 10 );
		$this->baseCms->setAdminJs( 'raphael', asset( config( 'settings.admin' ) . '/plugins/components/raphael/raphael-min.js' ), array( 'jquery' ), '1', false, 10 );
		$this->baseCms->setAdminJs( 'morris', asset( config( 'settings.admin' ) . '/plugins/components/morrisjs/morris.js' ), array( 'jquery' ), '1', false, 10 );

		$this->baseCms->setAdminJs( 'chartist', asset( config( 'settings.admin' ) . '/plugins/components/chartist-js/dist/chartist.min.js' ), array( 'jquery' ), '1', false, 10 );
		$this->baseCms->setAdminJs( 'chartist-plugin-tooltip', asset( config( 'settings.admin' ) . '/plugins/components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js' ), array( 'jquery' ), '1', false, 10 );

		$this->template = 'admins.' . config( 'settings.admin' ) . '.index';

	}

	/**
	 * @return IndexController|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function index() {
		$this->title = __( 'admin.Dashboard' );

		if ( Gate::denies( 'VIEW_ADMIN' ) ) {

			return redirect( route('admin.users.edit',['users' => Auth()->user()->id]));
			abort( 403 );

		}


		$this->userWidget();

		return $this->renderOutput();
	}


	/**
	 *
	 */
	public function userWidget() {
		Eventy::addAction( 'dashboard.bottom-widget', function () {

			$users = User::with( 'roles' )->get();


			?>

            <div class="row">
                <div class="col-md-12">
                    <div class="white-box user-table">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="box-title"><?php  echo __('Table Format/User Data'); ?></h4>
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>

                                    <th><?php echo __( 'admin.User login' ); ?></th>
                                    <th><?php echo __( 'admin.User Name' ); ?></th>
                                    <th><?php echo __( 'admin.Email' ); ?></th>
                                    <th><?php echo __( 'admin.Role' ); ?></th>

                                </tr>
                                </thead>
                                <tbody>
								<?php if ( !$users->isEmpty() ) {
								    foreach ($users as $user){
								    ?>
                                    <tr>

                                        <td><a href="javascript:void(0);" class="text-link"><?php  echo $user->login; ?></a></td>
                                        <td><?php  echo $user->name; ?></td>
                                        <td><?php  echo $user->email; ?></td>
                                        <td><span class="label label-success"><?php  echo $user->roles->first()->name ?? ''; ?></span></td>

                                    </tr>
								<?php } }?>


                                </tbody>
                            </table>
                        </div>

                        <a href="<?php  echo route('admin.users.create') ?>" class="btn btn-success pull-right m-t-10 font-20">+</a>
                    </div>
                </div>
            </div>

			<?php
		} );
	}
}
