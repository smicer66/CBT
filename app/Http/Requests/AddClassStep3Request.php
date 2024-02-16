<?php namespace App\Http\Requests;

class AddClassStep3Request extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $exam_id = $this->route('exams');
        $this->redirect = "/admin/exams/".$exam_id."/class/upload";
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
            'level' => 'required'
        ];
    }

}
