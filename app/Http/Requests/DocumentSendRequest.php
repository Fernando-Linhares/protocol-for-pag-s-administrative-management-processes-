<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CalledSelf;
use App\Rules\HasUser;

class DocumentSendRequest extends FormRequest
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
            'user'=>[
                'required',
                new HasUser,
                new CalledSelf
            ],
            'id'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'user.required'=>'nome do destinatário obrigatório',
            'id.required'=>'selecione um item para envio',
        ];
    }
}
