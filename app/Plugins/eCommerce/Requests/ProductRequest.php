<?php

namespace Corp\Plugins\eCommerce\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest {
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
			'title' => 'required|max:255',
			'text' => 'required',
			'meta_desc' => 'required|max:255',
			//  'category_id' => 'required|integer'
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

			'title.required' => __('The name field can not be blank value'),
			'text.required' => __('The Description can not be blank value'),

		];

	}
}
