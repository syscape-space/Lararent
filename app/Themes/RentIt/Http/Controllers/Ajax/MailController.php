<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 02.10.2018
 * Time: 15:18
 */

namespace Corp\Themes\RentIt\Http\Controllers\Ajax;
use Corp\Http\Controllers\Controller;
use Corp\Themes\RentIt\Mail\DemoEmail;
use Illuminate\Http\Request;
use Response;
use Mail;

class MailController   extends Controller{
	public function send(Request $request)
	{

		$email = get_theme_mod('rentit_email_to');
		$arr_emails = explode(',',$email);

		$to = isset($arr_emails[0]) ? $arr_emails : $email;

		Mail::to($to)->send(new DemoEmail($request));

		return Response::json([
			'message' => __('admin.Contact-Form-Submitted')
		], 201); // Status code here
	}
}