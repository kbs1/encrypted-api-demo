<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Demo100Request extends FormRequest
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
			'get_parameter__' => 'present',
			'get_parameter_2' => 'required|array',
			'test_test_' => 'present',
			'test2' => 'required|array',
		];
	}
}
