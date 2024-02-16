<?php namespace App\Http\Requests;

class UserCreateRequest extends Request
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
            'first_name' => 'required|max:30|alpha',
            'last_name' => 'required|max:30|alpha',
            'role_id' => 'required|integer',
            'identity_no' => 'required|unique:users,identity_no',
        ];
    }

}