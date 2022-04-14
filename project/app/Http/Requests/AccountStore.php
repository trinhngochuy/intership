<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AccountStore extends FormRequest
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
            'first_name' => 'required',
            'last_name'=>'required',
            'email'=>'required',
            'user_name' => 'required',
            'password' => 'required',
            'confirm_password'=>'required|same:password',
            'birthday'=>'required',

        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'canot be empty',
            'last_name.required'=>'canot be empty',
            'email.required'=>'canot be empty',
            'user_name.required' => 'canot be empty',
            'password.required' => 'canot be empty',
            'confirm_password.required'=>'canot be empty',
            'birthday.required'=>'canot be empty',
            'birthday.required.same:password'=>'mismatched',
        ];
    }
    public function withValidator($validator)
    {

        $validator->after(function ($validator) {
//            if ($this->get('created_at')!=null||$this->get('updated_at')!=null){
//                $created = Carbon::parse($this->get('created_at'));
//                $updated = Carbon::parse($this->get('updated_at'));
//                $result = $created->lte($updated);
//
//                if($result==true ){
//                    $validator->errors()->add('Postday', 'Post date must be greater than creation date:' .$result);
//                }
//            }

        });

    }
}
