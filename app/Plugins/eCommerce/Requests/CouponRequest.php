<?php

namespace Corp\Plugins\eCommerce\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			//
			'code' => 'required|max:255',
			'type' => 'required',
			'value' => 'required',

		];
	}

	/**

	 * Get the error messages for the defined validation rules.

	 *

	 * @return array

	 */

	public function messages()

	{

		return [

			'title.required' => __('The location name  can not be blank value'),
			'alias.required' => __('The  location alias can not be blank value'),

		];

	}
}
