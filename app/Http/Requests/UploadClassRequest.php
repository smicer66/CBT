<?php namespace App\Http\Requests;
use Input;

class UploadClassRequest extends Request
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
        $input = Input::all();
        if($input['buttonClicked']==0)
        {
            return [
                'examination_id' => 'required'
            ];
        }else {
            return [
                'candidates' => 'required',
                'examination_id' => 'required'
            ];
        }
    }

    public function messages()
    {
        $messages = [
            'examination_id.required' => 'A system error occurred.',
            'candidates.required' => 'You must upload an excel sheet.'
        ];

        return $messages;
    }
}
