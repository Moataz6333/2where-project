<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required','min:2','max:255'],
            'description'=>['required','min:2'],
            'phone'=>['required','min:2','max:255'],
            'phone2'=>['required','min:2','max:255'],
            'email'=>['required','min:2','max:255','unique:compainies,email'],
            'bank'=>['required','min:2','max:255'],
            'postPhoto'=>['required','image'],
            'founder_name'=>['required','min:2','max:255'],
            'founder_phone'=>['required','min:2','max:255'],
            'national_id'=>['required','min:2','max:255'],
        ];
    }
}
