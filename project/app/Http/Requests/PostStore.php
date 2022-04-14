<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PostStore extends FormRequest
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
            'title' => 'required|min:10',
        'description'=>'required|min:0',
        'created_at'=>'required',
            'content' => 'required',
            'category_id'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'cannot be left blank',
            'description.required' => 'description cannot be left blank',
            'title.min' => 'title is too short',
            'description.min' => 'description is too short',
            'created_at.required'=>'created cannot be left blank',
        ];
    }
    public function withValidator($validator)
    {

         $validator->after(function ($validator) {
            if ($this->get('created_at')!=null||$this->get('updated_at')!=null){
                $created = Carbon::parse($this->get('created_at'));
                $updated = Carbon::parse($this->get('updated_at'));
                $result = $created->lte($updated);

                if($result==true ){
                    $validator->errors()->add('Postday', 'Post date must be greater than creation date');
                }
            }

         });

    }
}
