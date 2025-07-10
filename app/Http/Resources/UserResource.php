<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\Permission\Models\Role;

/**
 * @mixin User
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     *
     * @return array<string, mixed>
     */


    public function toArray(Request $request): array
    {
        $role = $this->roles()->first();
        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "email"=> $this->email,
            "role" => $role instanceof Role ? $role->name : null
        ];
    }
}
