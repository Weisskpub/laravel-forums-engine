<?php
namespace Hzone\LFE\Request;

use Illuminate\Foundation\Http\FormRequest;

class ValidateNewTopic extends FormRequest
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
			'title' => [
				'required',
				'min:4',
				'max:160',
			],
			'message' => [
				'required',
				'min:4',
			],
			'forum_id' => [
				'required',
				'numeric'
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
			'title.required'    => trans('LFE::LFE.validator.title.required'),
			'title.min'         => trans('LFE::LFE.validator.title.min'),
			'title.max'         => trans('LFE::LFE.validator.title.max'),
			'message.required'  => trans('LFE::LFE.validator.message.required'),
			'message.min'       => trans('LFE::LFE.validator.message.min'),
			'forum_id.required' => trans('LFE::LFE.validator.forum_id.required'),
			'forum_id.integer'  => trans('LFE::LFE.validator.forum_id.numeric'),
		];
	}
}
