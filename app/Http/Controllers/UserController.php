<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Response;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;

#[Group(name: 'User Auth')]

class UserController extends Controller
{
    /**
     * Register User
     *
     * Register new user
     *
     * @throws ValidationException
     */
    #[ResponseFromApiResource(UserResource::class, User::class)]
    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        $user->assignRole(UserRole::USER);

        return new UserResource($user);
    }

    /**
     * Login User
     *
     *
     * Login a user and return a token.
     *
     * @throws ValidationException
     */
    #[ResponseFromApiResource(UserResource::class, User::class, additional: ['token' => '5|kBPlXpDNHg491Yg5qTJr2jdTq9PL8L8Z8i0w4jYz22d20fdc'])]
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'data' => new UserResource($user),
            'access_token' => $token,
        ];
    }

    /**
     * Logout User
     *
     * Log user out
     */
    #[Authenticated]
    #[Response(['message' => 'Logged out successfully'])]
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully!',
        ]);
    }
}
