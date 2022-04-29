<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13.12.2018
 * Time: 12:58
 */

namespace Corp\Http\Controllers\Admin;


use Artisan;
use Corp\Http\Controllers\Controller;
use Corp\Permission;
use Corp\Role;
use Corp\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;


class InstallController extends Controller {


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showInstall() {
        if ( view()->exists( 'admins.' . config( 'settings.admin' ) . '.install.install' ) ) {
            return view( 'admins.' . config( 'settings.admin' ) . '.install.install' );
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function installCms( Request $request ) {

        $result = $this->runInstall( $request );

        if ( is_array( $result ) && !empty( $result['error'] ) ) {


            return redirect('lr-install')->with( $result )->withInput( $request->all );
        } else {
            return redirect( 'admin' );

        }


    }

    /**
     * @param Request $request
     * @return array|bool
     */
    public function runInstall( Request $request ) {

        $error = [];
        $data = $request->except( '_token' );

        $validator = Validator::make( $data, [

            'db_hostname' => 'required',
            'db_username' => 'required',
            'db_password' => 'string|required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'email' => 'email',


        ] );

        if ( $validator->fails() ) {
            return [ 'error' => $validator->errors()->all() ];
        }


        $db_hostname = e( $request->db_hostname ?? '' );
        $db_username = e( $request->db_username ?? '' );
        $db_database = e( $request->db_database ) ?? '';
        $db_password = e( $request->db_password ) ?? '';
        $Password = e( $request->password ) ?? '';


        $login = e( $request->login );
        $name = e( $request->name );
        $email = e( $request->email );

        $this->putPermanentEnv( 'DB_HOST', $db_hostname );
        $this->putPermanentEnv( 'DB_USERNAME', $db_username );
        $this->putPermanentEnv( 'DB_DATABASE', $db_database );
        $this->putPermanentEnv( 'DB_PASSWORD', $db_password );
        putenv('DB_HOST='.$db_hostname);
        putenv('DB_USERNAME='.$db_username);
        putenv('DB_DATABASE='.$db_database);
        putenv('DB_PASSWORD='.$db_password);

        Artisan::call( 'cache:clear' );


        try {
            $p =	DB::connection()->getPdo();

        } catch ( \Exception $e ) {

            return ['error' => 'Wrong DB data '. $e->getMessage()];

        }
        $http = isset( $_SERVER['HTTPS'] ) && strtolower( $_SERVER['HTTPS'] ) !== 'off' ? 'https' : 'http';
        $hostname = $_SERVER['HTTP_HOST'];
        $this->putPermanentEnv( 'APP_URL', $http . '://' . $hostname );
        $this->putPermanentEnv( 'APP_DEBUG', 'false' );

        putenv('APP_URL='.$http . '://' . $hostname );
        putenv('APP_DEBUG=false');

        Artisan::call( 'cache:clear' );
        //	if ( !$error ) {

        $exitCode = Artisan::call( 'migrate' );
        $exitCode = Artisan::call( 'cache:clear' );

        $u = User::create( [
            'name' => $name,
            'login' => $login,
            'email' => $email,
            'password' => Hash::make( $Password ),
        ] );


        DB::table( 'roles' )->insert( [
            [ 'name' => 'Admin' ],
            [ 'name' => 'Moderator' ]

        ] );


        $u->roles()->attach( 1 );
        DB::table( 'permissions' )->insert( [
            [ 'name' => 'VIEW_ADMIN' ],
            [ 'name' => 'ADD_POSTS' ],
            [ 'name' => 'UPDATE_POSTS' ],
            [ 'name' => 'DELETE_POSTS' ],
            [ 'name' => 'ADMIN_USERS' ],
            [ 'name' => 'VIEW_ADMIN_POSTS' ],
            [ 'name' => 'EDIT_USERS' ],
            [ 'name' => 'VIEW_ADMIN_MENU' ],
            [ 'name' => 'EDIT_MENU' ],
            [ 'name' => 'MEDIAS.CREATE' ],
            [ 'name' => 'MEDIAS.UPDATE' ],
            [ 'name' => 'MEDIAS.DELETE' ],
            [ 'name' => 'REGENERATE_THUMBNAILS_ADMIN' ],

        ] );


        $allPermission = Permission::all();

        $allPermsIds = [];
        foreach ( $allPermission as $per ) {
            $allPermsIds[] = $per->id;
        }


        $role = Role::where( 'id', 1 )->first();

        $role->perms()->sync(
            $allPermsIds

        );


        $config = [
            'is_installed' => true,
            'version' => config('settings.lr_version')
        ];
        $fp = fopen( base_path() . '/config/lararent.php', 'w' );
        fwrite( $fp, '<?php return ' . var_export( $config, true ) . ';' );
        fclose( $fp );


        //}
        return true;
    }

    public function putPermanentEnv( $key, $value ) {
        $path = app()->environmentFilePath();

        $escaped = preg_quote( '=' . env( $key ), '/' );

        file_put_contents( $path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents( $path )
        ) );
    }
}
