<?php

namespace App\Traits\SwaggerDocumentation;

trait AuthSwagger
{
  /**
   * @OA\Post(
   *     path="/api/auth/login",
   *     summary="Login",
   *     tags={"Auth"},
   *     @OA\RequestBody(
   *         required=true,
   *         @OA\JsonContent(
   *             required={"username","password"},
   *             @OA\Property(property="username", type="string", example="superadmin"),
   *             @OA\Property(property="password", type="string", format="password", example="password")
   *         )
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="Login successful",
   *         @OA\JsonContent(
   *             @OA\Property(property="status", type="integer", example=200),
   *             @OA\Property(property="message", type="string", example="Login successful."),
   *             @OA\Property(property="records", type="object",
   *                 @OA\Property(property="data", type="object",
   *                     @OA\Property(property="id", type="string", example="0195b228-66a7-7029-ada8-321debcd9f82"),
   *                     @OA\Property(property="username", type="string", example="superadmin"),
   *                     @OA\Property(property="email", type="string", format="email", example="bagasarya@gmail.com"),
   *                     @OA\Property(property="roles", type="array",
   *                         @OA\Items(
   *                             @OA\Property(property="id", type="string", example="5347ab2f-5db8-4d3d-b36a-a3200f543322"),
   *                             @OA\Property(property="name", type="string", example="super admin"),
   *                             @OA\Property(property="slug", type="string", example="super-admin"),
   *                             @OA\Property(property="created_at", type="string", format="date-time", example="2025-03-20T06:05:46.000000Z")
   *                         )
   *                     ),
   *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-03-20T06:05:47.000000Z")
   *                 ),
   *                 @OA\Property(property="token", type="string", example="9|f7aRSjiisgkt2TiwYqojnloijnD8jHdmR62PJX18a2e52150")
   *             )
   *         )
   *     ),
   *     @OA\Response(
   *         response=401,
   *         description="Unauthorized",
   *         @OA\JsonContent(
   *             @OA\Property(property="status", type="integer", example=401),
   *             @OA\Property(property="message", type="string", example="Invalid username or password.")
   *         )
   *     )
   * )
   */
  public function authDocs() {}
}
