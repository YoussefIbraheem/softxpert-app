<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\ChangeUserTypeRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Response;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;
use Knuckles\Scribe\Attributes\UrlParam;

#[Group(name: 'User Auth')]

class UserController extends Controller
{
    /**
     * Register User
     *
     * Register new user
     *
     * Access Level: N/A
     *
     * @return UserResource
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
     * Access Level: N/A
     *
     * @return array
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
     *
     * Access Level: N/A
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

    /**
     * Get Users
     *
     * get list of users
     *
     * Access Level : Manager
     */
    #[Authenticated]
    #[ResponseFromApiResource(UserResource::class, User::class, collection: true, factoryStates: ['roles'])]
    public function getUsers(Request $request): AnonymousResourceCollection
    {
        $data = User::all();

        return UserResource::collection($data);
    }

    /**
     * Get User
     *
     * Get a selected user depending on the id
     *
     * Access Level: Manager
     */
    #[Authenticated]
    #[ResponseFromApiResource(UserResource::class, User::class),UrlParam(name: 'id', type: 'int', description: 'searched user\'s id', example: 1)]
    public function getUser(int $id): UserResource
    {
        $data = User::findOrFail($id);

        return new UserResource($data);
    }

    /**
     * Get Logged In User
     *
     * get user's own data
     *
     * Access Level: N/A
     */
    #[Authenticated]
    #[ResponseFromApiResource(UserResource::class, User::class)]
    public function getLoggedInUser(Request $request): UserResource
    {
        $user = $request->user();

        return new UserResource($user);
    }

    /**
     * Change User Role
     *
     * Changes the user role from user to manager or vice versa.
     *
     * Access Level: Admin
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

    /**
     * Update User
     *
     * Update user's own data such as (name ,  email , password)
     * Password confirmation is required only when there is a new password entered
     *
     * Access Level: N/A
     */
    #[Authenticated]
    #[ResponseFromApiResource(UserResource::class, User::class)]
    public function updateUser(UpdateUserRequest $request): UserResource
    {
        $user = User::findOrFail($request->user()->id);

        $user->update($request->all());

        return new UserResource($user);

    }
}
