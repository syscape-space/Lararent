<?php

namespace Corp\Plugins\eCommerce\Requests;

use Corp\Plugins\eCommerce\Models\Term;
use Illuminate\Foundation\Http\FormRequest;

class EcomerceSettingsRequest extends FormRequest
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
			'currency' => 'required|max:255',
			'currency_code' => 'required|max:255',


		];
	}
}
