<?php namespace App\Http\Requests;

use Auth;

class ExaminationsRequest extends Request
{

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        $this->redirect = "admin/exams/create";
        return true;
//        if (Auth::user()->can('create_exams')) {
//            return true;
//        }
//
//        return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'course_id' => 'required|numeric',
			'title' => 'required',
//			'no_of_questions' => 'required|numeric|max:1000',
			'question_score_weight' => 'sometimes|numeric|max:1000',
//			'duration' => 'required|numeric|max:10000',
            'instructions' => 'required'
		];
	}

	public function messages()
	{
        $messages = [
			'course_id.required' => 'You must select a course in order to continue.',
			'course_id.numeric' => 'The course you selected is invalid',
			'no_of_questions.required' => 'Please set the number of questions.',
			'exam_date.required' => 'Please select a date for the examination'
		];

        return $messages;
	}

}
