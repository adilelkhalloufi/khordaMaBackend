<?php

namespace App\Http\Controllers;

use App\Actions\User\CreateUser;
use App\Mail\CodeVerification;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! auth()->attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $user = auth()->user();

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function register(
        Request $request,
        CreateUser $createUser
    ): JsonResponse {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user = $createUser->execute($request->all());

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out',
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json(auth()->user());
    }

    public function updateProfile(Request $request): JsonResponse
    {
        $user = auth()->user();

        $user->update($request->all());

        return response()->json($user);
    }

    public function updatePassword(Request $request): JsonResponse
    {
        $user = auth()->user();

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return response()->json($user);
    }

    public function forgetPassword(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return response([
                'message' => 'User not found',
            ], 404);
        }

        $code = rand(1000, 9999);

        $user->update([
            'code_verify' => $code,
        ]);

        Mail::to($user->email)->send(new CodeVerification($user));

        return response()->json([
            'message' => 'Code sent to your email',
        ]);
    }
}
