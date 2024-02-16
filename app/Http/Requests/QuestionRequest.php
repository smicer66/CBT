<?php namespace App\Http\Requests;

class QuestionRequest extends Request
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
        $rules = [
			'title' => 'required',
			'correct_answers' => 'required',
            'score_weight' => 'required|numeric'
		];
        foreach ($this->request->get('options') as $key => $val) {
            $rules['options.' . $key] = 'required';
		}

        return $rules;
	}

//
	public function messages()
	{
		$messages['correct_answers.required'] = 'you must select at least one correct answer';
		$messages['score_weight.required'] = 'The score field is required';
		$messages['score_weight.numeric'] = 'The score field must contain a number';
//		foreach($this->request->get('correct_answers') as $key => $val) {
//		{
//			$messages['correct_answers.'.$key.'.required'] = '';
//		}
		return $messages;
	}
}
