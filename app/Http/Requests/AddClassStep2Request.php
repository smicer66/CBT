<?php namespace App\Http\Requests;

class AddClassStep2Request extends Request
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
//        dd($this->redirect);
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
            'faculty' => 'required'
        ];
    }

}
