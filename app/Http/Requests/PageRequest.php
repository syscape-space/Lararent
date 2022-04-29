<?php

namespace Corp\Http\Requests;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

	  /*  if( Gate::allows( 'ADD_PAGES' )){
		    return true;
	    }*/
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
              'title' => 'required|max:255',
		   // 'text' => 'required',
		    'meta_desc'  => 'required|max:255',
        ];
    }
}
