<?php

namespace App\Http\Controllers;

use App\Actions\User\CreateUser;
use App\enum\ProfilStatus;
use App\Mail\CodeVerification;
use App\Models\User;
 use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function GetCoins(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        return response()->json([
            'coins' => $user->coins,
        ]);
    }
    
    public function login(Request $request) 
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

        if ($user->status != ProfilStatus::ACTIF->value) {
            return response([
                'message' => 'Your account is inactive',
            ], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'favoris' => $user->favorites,
            'token' => $token,
        ]);
    }

    public function register(
        Request $request,
        CreateUser $createUser
    ) {
        $request->validate([
            'company_name' => 'required',
            'role' => 'required',
            'password' => 'required',
            'email' => 'required|email',
            'specialitie_id' => 'required',
            'interests' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city_id' => 'required',
            'agreement' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',

        ]);

        $user = $createUser->execute($request->all());

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out',
        ]);
    }

    public function me(Request $request)
    {
        return response()->json(auth()->user());
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $user->update($request->all());

        return response()->json($user);
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return response()->json($user);
    }

    public function forgetPassword(Request $request)
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
