<?php namespace App\Http\Requests;

class DepartmentUpdateRequest extends Request
{


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
            'name' => 'required',
            'faculty_id' => 'required|integer',
            'original_faculty_id' => 'required|integer',
        ];
    }

}