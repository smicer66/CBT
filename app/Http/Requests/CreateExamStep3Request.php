<?php namespace App\Http\Requests;

class CreateExamStep3Request extends Request
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
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'department' => 'required',
//            'level' => 'required'
        ];
    }

}
