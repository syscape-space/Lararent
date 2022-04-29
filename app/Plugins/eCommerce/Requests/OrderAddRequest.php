<?php

namespace Corp\Plugins\eCommerce\Requests;

use Corp\Plugins\eCommerce\Models\Term;
use Illuminate\Foundation\Http\FormRequest;

class OrderAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
	public function authorize()
	{
		return true;
	}



	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			//
			'PickingUpLocation' => 'required|max:255',
			'PickingUpDate' => 'required|max:255',
			'PickingUpHour' => 'required|max:255',
		/*	'DroppingOffLocation' => 'required|max:255',
			'DroppingOffDate' => 'required|max:255',
			'DroppingOffHour' => 'required|max:255',*/
			'name' => 'required|max:255',
			'email' => 'required|max:255|email',
			'phone' => 'required|max:255',
			'product_id' => 'required|max:255',
			'payment' => 'required|max:255',


		];
	}

}
