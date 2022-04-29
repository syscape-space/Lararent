<?php

namespace Corp\Plugins\eCommerce\Requests;

use Corp\Plugins\eCommerce\Models\Term;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function getValidatorInstance()
	{
		$validator = parent::getValidatorInstance();



		$validator->sometimes('alias','unique:ec_terms|max:255', function($input) {

			if($this->route()->hasParameter('category')) {
				$model = $this->route()->parameter('category');

				$model = Term::where('id', $model)->select('alias')->first();


				return ($model->alias !== $input->alias)  && !empty($input->alias);
			}

			return !empty($input->alias);

		});

		return $validator;


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
			'title' => 'required|max:255',
			'alias' => 'required',

		];
	}
}
