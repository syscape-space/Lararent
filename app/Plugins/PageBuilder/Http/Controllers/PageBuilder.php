<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.11.2018
 * Time: 18:16
 */

namespace Corp\Plugins\PageBuilder\Http\Controllers;

use Corp\Page;
use Corp\Plugins\PageBuilder\Classes\RegisterModule;
use Corp\Plugins\PageBuilder\PageBuilderPlugin;
use Eventy;
use Gate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

/**
 * Class PageBuilder
 * @package Corp\Plugins\PageBuilder\Http\Controllers
 */
class PageBuilder extends PageBuilderPlugin {

	public function __construct( Application $app ) {
		parent::__construct( $app );
		//	add editor link to single product


	}

	public function boot() {

	}

	/**
	 * Get sidebar html code
	 * @return \Illuminate\Http\RedirectResponse|string
	 * @throws \Throwable
	 */
	public function getSidebar() {
		if ( !Gate::allows( 'VIEW_ADMIN_PAGES' ) ) {
			return back();
			abort( 403 );
		}

		$RegisterModule = RegisterModule::getInstance();
		$modules = $RegisterModule->getModules();
		$content = $this->getTemplate( 'sidebar', compact( 'modules' ) );

		return $content;
	}

	/**
	 * Get html code module when we drop it on page
	 * @param Request $request
	 * @return mixed
	 */
	public function getModule( Request $request ) {


		if ( $request->module && $request->type == 'page' ) {
			$page = Page::where( 'id', $request->id )->first();

			$RegisterModule = RegisterModule::getInstance();
			$modules = $RegisterModule->getModules();


			if ( isset( $modules[$request->module]['path'] ) ) {

				$module = new $modules[$request->module]['path']( $page );
				return $module->show();
			}
		}

	}

	/**
	 * Save all modules in page
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function save( Request $request ) {
	//	dd($request->all());

		if ( !Gate::allows( 'VIEW_ADMIN_PAGES' ) ) {
			return back();
			abort( 403 );
		}

		$modules = $request->modules ?? '';

		if ( $request->type == 'page' ) {
			$RegisterModule = RegisterModule::getInstance();
			$RegisteredModules = $RegisterModule->getModules();

			$page = Page::where( 'id', (int) $request->id )->first();
			$i = 0;
			foreach ( $modules as $k => $v ) {

				preg_match( '#__(\d+)$#', $k, $math );

				preg_match( '#(\w+)__\d+$#', $k, $math_2 );


				// not saved

				if (isset($math_2[1]) && isset($RegisteredModules[$math_2[1]]['type']) && $RegisteredModules[$math_2[1]]['type'] == 'php' ) {
					$v = '';
				}

				if(is_array($v)){

				  //  dd($v);
                } else {
					// find module by name and update it or create new one
					$item = $page->module()->updateOrCreate( [
						'name' => $k,
					], [
						'sorting' => $i,
						'code' => app()->getLocale(),
						'variables' => '',
						app()->getLocale() =>
							[ 'variables' => '', 'value' => $v, ],
					] );


					$item->save();
				}

				$i ++;



			}

		}


	}

	/**
	 * We get Module Options
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getModuleOptions( Request $request ) {
		if ( !Gate::allows( 'VIEW_ADMIN_PAGES' ) ) {
			return back();
			abort( 403 );
		}

		$value = "";

		$page = Page::where( 'id', (int) $request->id )->first();
		//dump($page);
		$module = ( $page->module()->where( 'name', $request->module_id )->first() );

		?>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#pb-options"><?php echo __( 'Options' ); ?></a></li>
            <li><a data-toggle="tab" href="#pb-html"><?php echo __( 'Html' ); ?></a></li>

        </ul>

        <div class="tab-content ">
            <div id="pb-options" class="tab-pane fade in active">

                <form class="pb_options_form">


                    <h4><?php echo __( 'Options' ) ?></h4>
					<?php
					$RegisterModule = RegisterModule::getInstance();
					$modules = $RegisterModule->getModules();
					preg_match( '#(\w+)__\d+$#', $request->module_id, $math );


					if ( isset( $modules[$math[1]]['path'] ) ) {


						$module_ob = new $modules[$math[1]]['path']( $page, $request->val );

						if ( !isset( $module->value{6} ) ) {

						$value = $module_ob->show( false, $modules[$math[1]] );


						} else {
							$value =  $module->value;
                        }
						if ( method_exists( $module_ob, 'options' ) ) {

							$module_ob->renderOptions( $module );


						}

					}

					?>
                </form>
            </div>
            <div id="pb-html" class="tab-pane fade">
                <div class="">
                    <h4><?php echo __( 'Edit html code' ) ?></h4>
                    <span style="color: red;"><?php echo __( 'don\'t delete classes in first section and ID, and don\'t change php code if you not know what you do' ) ?></span>
                    <textarea style="position: absolute;" class="form-control" id="pb-module-options-code" cols="30"
                              rows="10"><?php echo htmlspecialchars($value ?? ''); ?></textarea>
                </div>
            </div>

        </div>


		<?php
	}

	/**
	 * We save module and return new view
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function saveModule( Request $request ) {
		if ( !Gate::allows( 'VIEW_ADMIN_PAGES' ) ) {
			return back();
			abort( 403 );
		}


		$page = Page::where( 'id', (int) $request->id )->first();
		$RegisterModule = RegisterModule::getInstance();
		$modules = $RegisterModule->getModules();
		preg_match( '#(\w+)__\d+$#', $request->name, $math );

		$module_ob = new $modules[$math[1]]['path']( $page, $request->val );
		$module_ob->show( $request->val );


		parse_str( $request->form, $output );

		$item = $page->module()->updateOrCreate( [
			'name' => $request->name,
			//	'sorting' => $i
		], [
			'code' => app()->getLocale(),
			'variables' => '',
			app()->getLocale() =>
				[ 'variables' => serialize( $output ), 'value' => $request->val, ],
		] );


		return $module_ob->show( $item );


	}


	/**
	 * We delete module from db by id
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function DeleteModule( Request $request ) {
		if ( !Gate::allows( 'VIEW_ADMIN_PAGES' ) ) {
			return back();
			abort( 403 );
		}

		$page = Page::where( 'id', (int) $request->id )->first();
		$page->module()->where( 'name', $request->module_id )->first()->delete();

	}


}