<?php namespace App\Http\Requests;

class UploadQuestionsRequest extends Request
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
            'questions' => 'required',
            'examination_id' => 'required'
        ];
    }

    public function messages()
    {
        $messages = [
            'examination_id.required' => 'A system error occurred. Please refresh this page',
            'questions.required' => 'You must upload an excel sheet.'
        ];

        return $messages;
    }
}
