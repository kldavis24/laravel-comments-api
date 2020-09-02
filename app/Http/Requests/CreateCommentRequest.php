<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
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
	        'body' => 'required|string',
	        'email' => 'required|string|email',
	        'zip' => 'required|string|digits:5',
	        'state' => 'required|string',
	        'categories' => 'required|array',
	        'categories.*.title' => 'required|string',
	        'image' => 'present|base64image|nullable'
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
			'body.required' => 'Required JSON data missing: body',
			'body.string' => 'The following JSON data must be of type string: body',
			'email.required' => 'Required JSON data missing: email',
			'email.string' => 'The following JSON data must be of type string: email',
			'email.email' => 'Email must be properly formatted (example@email.com)',
			'zip.required' => 'Required JSON data missing: zip',
			'zip.string' => 'The following JSON data must be of type string: zip',
			'zip.digits' => 'Zip must be limited to 5 digits',
			'state.required' => 'Required JSON data missing: state',
			'state.string' => 'The following JSON data must be of type string: state',
			'categories.required' => 'Required JSON data missing: categories',
			'categories.array' => 'The following JSON data must be of type array: categories',
			'categories.*.title.required' => 'Required JSON data missing: category title',
			'categories.*.title.string' => 'The following JSON data must be of type string: category title',
			'image.present' => 'Required JSON data missing: image',
			'image.base64image' => 'The following JSON data must be of type base64 image: image',
		];
	}
}
