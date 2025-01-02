<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
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
        return [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'bank_number' => 'required',
            'about' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'image.image' => 'Seçilen dosya resim dosyası olmalıdır.',
            'image.mimes' => 'Seçilen dosya resim dosyası olmalıdır.',
            'image.max' => 'Dosya boyutu 2MB üzeri olamaz.',
            'first_name.required' => 'First name değeri boş bırakılamaz.',
            'last_name.required' => 'Last name değeri boş bırakılamaz.',
            'email.required' => 'Email değeri boş bırakılamaz.',
            'phone.required' => 'Phone değeri boş bırakılamaz.',
            'about.required' => 'About değeri boş bırakılamaz.',
            'bank_number.required' => 'Bank number değeri boş bırakılamaz.'
        ];
    }
}
