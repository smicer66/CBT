<?php namespace App\Http\Requests;

class CreateExaminationsRequest extends Request
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
            'course_id' => 'required|min:1|numeric',
            'title' => 'required|min:3',
//            'no_of_questions' => 'required|numeric',
//			'score_weight_type' => 'required',
//            'question_score_weight' => 'numeric',
//            'duration' => 'required|numeric',
            'exam_date' => 'required|date'
        ];
    }

}
