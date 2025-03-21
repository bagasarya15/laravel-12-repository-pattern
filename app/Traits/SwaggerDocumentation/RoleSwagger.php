<?php

namespace App\Traits\SwaggerDocumentation;

trait RoleSwagger
{
  /**
   * @OA\Schema(
   *     schema="Role",
   *     title="Role",
   *     @OA\Property(property="id", type="integer", example=1),
   *     @OA\Property(property="name", type="string", example="Super Admin"),
   *     @OA\Property(property="slug", type="string", example="super-admin")
   * )
   */

  /**
   * @OA\Get(
   *     path="/api/master/role",
   *     summary="Get all roles",
   *     tags={"Master - Role"},
   *     @OA\Response(
   *         response=200,
   *         description="Success",
   *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Role"))
   *     )
   * )
   */
  public function getRolesDocs() {}

  /**
   * @OA\Post(
   *     path="/api/master/role",
   *     summary="Create a new role",
   *     tags={"Master - Role"},
   *     @OA\RequestBody(
   *         required=true,
   *         @OA\JsonContent(
   *             required={"name", "slug"},
   *             @OA\Property(property="name", type="string", example="Manager"),
   *         )
   *     ),
   *     @OA\Response(
   *         response=201,
   *         description="Role created",
   *         @OA\JsonContent(ref="#/components/schemas/Role")
   *     )
   * )
   */
  public function createRoleDocs() {}

  /**
   * @OA\Put(
   *     path="/api/master/role/{id}",
   *     summary="Update a role",
   *     tags={"Master - Role"},
   *     @OA\Parameter(
   *         name="id",
   *         in="path",
   *         required=true,
   *         @OA\Schema(type="integer")
   *     ),
   *     @OA\RequestBody(
   *         required=true,
   *         @OA\JsonContent(
   *             @OA\Property(property="name", type="string", example="Updated Role"),
   *         )
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="Role updated",
   *         @OA\JsonContent(ref="#/components/schemas/Role")
   *     )
   * )
   */
  public function updateRoleDocs() {}

  /**
   * @OA\Delete(
   *     path="/api/master/role/{id}",
   *     summary="Delete a role",
   *     tags={"Master - Role"},
   *     @OA\Parameter(
   *         name="id",
   *         in="path",
   *         required=true,
   *         @OA\Schema(type="integer")
   *     ),
   *     @OA\Response(
   *         response=204,
   *         description="Role deleted"
   *     )
   * )
   */
  public function deleteRoleDocs() {}
}
