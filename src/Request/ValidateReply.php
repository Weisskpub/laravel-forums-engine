<?php

namespace Hzone\LFE\Request;

use Illuminate\Foundation\Http\FormRequest;

class ValidateReply extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		if ( config('LFE.allow_guests_new_topic')==true )
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'message' => [
				'required',
				'min:4',
			],
			'topic_id' => [
				'required',
				'numeric',
			],
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
			'message.required'  => trans('LFE::LFE.validator.message.required'),
			'message.min'       => trans('LFE::LFE.validator.message.min'),
			'topic_id.required' => trans('LFE::LFE.validator.topic_id.required'),
			'topic_id.integer'  => trans('LFE::LFE.validator.topic_id.numeric'),
		];
	}

}
