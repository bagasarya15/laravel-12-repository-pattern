<?php

namespace App\Http\Requests\Master\Petugas;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreRequest extends FormRequest
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
      'nama_lengkap' => ['required', 'string', 'max:255'],
      'no_registrasi' => [
        'nullable',
        'string',
        Rule::unique('petugas', 'no_registrasi')->whereNull('deleted_at')
      ],
      'alamat' => ['nullable', 'string'],
      'tanggal_lahir' => ['nullable', 'date'],
      'jenis_kelamin' => ['nullable', 'in:L,P'],
      'image' => ['nullable', 'string'],
      'expired_date' => ['nullable', 'date_format:Y-m-d H:i:s'],
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
    return [];
  }
}
