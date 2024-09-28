<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;



class UpdateRequest extends FormRequest
{


    // Adicione o parâmetro através do construtor
    public function __construct()
    {
        
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd($this->route('id'));
            return [
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|string|email|max:255|unique:users,email,'.$this->route('id'),
                'password' => 'sometimes|nullable|string|min:8',
                'doc' => 'sometimes|required|string|max:15|unique:users,doc,'.$this->route('id'),
                'phone_number' => 'nullable|string|max:15',
                ];

        //         return [
        //             'name' => 'sometimes|required|string|max:255',
        //             'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $this->userId,
        //             'password' => 'sometimes|nullable|string|min:8',
        //             'doc' => 'sometimes|required|string|max:15|unique:users,doc,' . $this->userId,
        //             'phone_number' => 'nullable|string|max:15',
        //         ];
                
        
    }

    protected function failedValidation(Validator $validator)
    {
    
        $rest = responseStatus('D', 1, 422, "", $validator->errors());
        throw new HttpResponseException($rest);
        

    }
}
