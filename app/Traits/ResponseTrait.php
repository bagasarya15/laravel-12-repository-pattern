<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ResponseTrait
{
  public function wrapResponse(int $status, string $message, ?array $resource = []): JsonResponse
  {
    $result = [
      'status' => $status,
      'message' => $message
    ];

    if (!empty($resource)) {
      $result['records'] = $resource['data'];

      if (count($resource) > 1) {
        $result['pages'] = [
          'links' => $resource['links'],
          'meta' => $resource['meta']
        ];
      }
    }

    return response()->json($result, $status);
  }

  public function httpCode($key = null)
  {
    $codes = [
      'OK' => Response::HTTP_OK,
      'CREATED' => Response::HTTP_CREATED,
      'UNPROCESSABLE' => Response::HTTP_UNPROCESSABLE_ENTITY,
      'UNAUTHORIZED' => Response::HTTP_UNAUTHORIZED,
      'FORBIDDEN' => Response::HTTP_FORBIDDEN
    ];

    return $key ? ($codes[strtoupper($key)] ?? Response::HTTP_INTERNAL_SERVER_ERROR) : $codes;
  }

  public function message($key = null)
  {
    $locale = env('APP_LOCALE', 'en');

    $messages = [
      'en' => [
        'SUCCESS' => 'Data loaded successfully.',
        'CREATED' => 'Create data successfully.',
        'UPDATED' => 'Update data successfully.',
        'DELETED' => 'Delete successfully.',
        'INVALID_CREDENTIALS' => 'Invalid username or password.',
        'LOGIN_SUCCESS' => 'Login successful.',
        'FORBIDDEN' => 'Restricted access.'
      ],
      'id' => [
        'SUCCESS' => 'Data berhasil dimuat.',
        'CREATED' => 'Data berhasil dibuat.',
        'UPDATED' => 'Data berhasil diperbarui.',
        'DELETED' => 'Data berhasil dihapus.',
        'INVALID_CREDENTIALS' => 'Username atau password salah.',
        'LOGIN_SUCCESS' => 'Login berhasil.',
        'FORBIDDEN' => 'Akses dibatasi.'
      ]
    ];

    $selectedMessages = $messages[$locale] ?? $messages['en'];

    return $key ? ($selectedMessages[strtoupper($key)] ?? 'Message not found.') : $selectedMessages;
  }
}
