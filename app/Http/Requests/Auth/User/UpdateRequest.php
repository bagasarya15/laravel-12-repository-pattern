<?php

namespace App\Http\Requests\Auth\User;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateRequest extends FormRequest
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
      'username' => ['required', 'string', Rule::unique('users', 'username')->whereNull('deleted_at')->ignore($this->route('id'))],
      'email' => ['nullable', 'email', Rule::unique('users', 'email')->whereNull('deleted_at')
        ->ignore($this->route('id'))],
      'password' => ['nullable', 'min:6']
    ];
  }

  /**
   * Prepare the data for validation.
   */
  protected function prepareForValidation(): void
  {
    // $this->merge([
    // ]);
  }


  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [];
  }
}
