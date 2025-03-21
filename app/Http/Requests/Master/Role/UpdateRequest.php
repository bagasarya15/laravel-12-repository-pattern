<?php

namespace App\Http\Requests\Master\Role;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

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
      'name' => [
        'required',
        'string',
        Rule::unique('roles', 'name')
          ->ignore($this->route('id'))
          ->whereNull('deleted_at'),
      ],
    ];
  }

  /**
   * Prepare the data for validation.
   */
  protected function prepareForValidation(): void
  {
    // $this->merge([]);
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'name.required' => 'name harus diisi',
      'name.unique' => "{$this->name} tidak tersedia",
    ];
  }
}
