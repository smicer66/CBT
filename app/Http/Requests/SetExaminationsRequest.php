<?php namespace App\Http\Requests;

class SetExaminationsRequest extends Request
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
            'instructions' => 'required',
            'duration' => 'required|numeric|min:1',
            'exam_date' => 'required',
            'question_delivery' => 'required',
            'no_questions_per_page' => 'required|numeric',
//            'status' => 'required'
        ];
    }

}
