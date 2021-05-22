<?php

namespace App\Http\Requests;

use App\Rules\HasDocument;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DocumentCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required|max:50|min:5',
            'content'=>'required|min:10',
            'unit'=>'required',
            'number'=>[
                'required',
                new HasDocument
            ],
            'vol'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'campo titulo é obrigatorio',
            'content.required'=>'campo assunto é obrigatorio',
            'unit.required'=>'campo unidade é obrigatorio',
            'number.required'=>'campo número é obrigatorio',
            'vol.required'=>'campo volume é obrigatorio',
        ];
    }
}
