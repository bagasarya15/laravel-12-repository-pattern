<?php

namespace App\Http\Requests\Log\DeviceBindingPeserta;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UnbindDeviceRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'device_id'   => ['required', 'string', 'max:255'],
      'peserta_id'  => ['required', 'uuid', 'exists:peserta,id'],
    ];
  }

  public function messages(): array
  {
    return [];
  }
}
