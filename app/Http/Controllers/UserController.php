<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Knuckles\Scribe\Attributes\Group;
use App\Http\Requests\RegisterRequest;
use Knuckles\Scribe\Attributes\Response;
use App\Http\Requests\ChangeUserTypeRequest;
use Knuckles\Scribe\Attributes\Authenticated;
use Illuminate\Validation\ValidationException;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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

    #[Authenticated]
    #[ResponseFromApiResource(UserResource::class, User::class)]
    public function getUsers(Request $request): AnonymousResourceCollection
    {
        $data = User::all();

        return UserResource::collection($data);



    }


    #[Authenticated]
    #[ResponseFromApiResource(UserResource::class, User::class)]
    public function getUser(int $id): UserResource
    {
        $data = User::findOrFail($id);

        return new UserResource($data);



    }

    /**
     * Change User Role
     *
     * Changes the user role from user to manager or vice versa.
     * This Action is only Limited to user with ADMIN access level
     *
     * @return UserResource
     */
    #[Authenticated]
    #[ResponseFromApiResource(UserResource::class, User::class)]
    public function changeUserRole(ChangeUserTypeRequest $request)
    {
        $user = User::findOrFail($request->user_id);

        if ($request->user_id == $request->user()->id) {
            abort(403, 'You cannot change your own role.');
        }

        if ($user->hasRole(UserRole::ADMIN)) {
            abort(403, 'You cannot change an admin\'s role.');
        }

        $user->syncRoles([]);

        $user->assignRole($request->role_name);

        return new UserResource($user);
    }
}
