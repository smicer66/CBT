<?php namespace App\Http\Requests;

class UserUpdateRequest extends Request
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
        return $rules = [
            'first_name' => 'required|max:30|alpha',
            'last_name' => 'required|max:30|alpha',
            'identity_no' => 'required|unique:users,identity_no,' . $this->get('id')
        ];
    }

}
