<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct() {
    }

  public function register(RegisterUserRequest $register_request)
  {
    $request = $register_request->validated();
    $user = User::create([
        "name"=> $request["name"],
        "email"=> $request["email"],
        "password"=> bcrypt($request["password"]),
        ]);

        $user->assignRole(UserRole::USER);
  }
}
