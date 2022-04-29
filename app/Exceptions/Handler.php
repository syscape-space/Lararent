<?php

namespace Corp\Exceptions;


use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use View;

class Handler extends ExceptionHandler {
	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		//
	];

	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var array
	 */
	protected $dontFlash = [
		'password',
		'password_confirmation',
	];

	/**
	 * Report or log an exception.
	 *
	 * @param  \Exception $exception
	 * @return void
	 */
	public function report( Exception $exception ) {
		parent::report( $exception );
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Exception $exception
	 * @return \Illuminate\Http\Response
	 */
	public function render( $request, Exception $exception ) {


		if ( $this->isHttpException( $exception ) && $exception->getStatusCode() == '404' ) {
			// if class exits in theme we render this error via method show
			$error_ob = "\Corp\Themes\\" . session( 'lr_active_theme_slug' ) . '\Http\Controllers\Error404';
			if ( class_exists( $error_ob ) && method_exists( $error_ob, 'show' ) ) {
				$error_ob = new $error_ob;
				return response( $error_ob->show(), 404 );

			}

		}
		if ( $exception instanceof \PDOException ) {
			if ( $exception->getCode() == '1045' || $exception->getCode() == '664' || $exception->getCode() == '664' || $exception->getCode() == '2002' ) {
				//dd('check  your database config in env file');
			};
		}
		return parent::render( $request, $exception );
	}
}
