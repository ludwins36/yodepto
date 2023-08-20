<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PassportAuthController extends Controller
{
    public function register(Request $request)
    {
        $userData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'status' => 'required',
            'rol_id' => 'required'
        ]);

        $userData['password'] = Hash::make($request->password);

        $user = User::create($userData);

        $user->refresh();

        //\Log::debug($user);
        $today = date("Y-m-d H:i:s");
        $payment = new Payment();
        $payment->date_payment = $today;
        $payment->date_from = $today;
        $payment->date_to = $today;
        $payment->payment_amount = 0;
        $payment->user_id = $user->id;
        $payment->plan_id = 2;
        $payment->save();

        $token = $user->createToken('Token')->accessToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('Token')->accessToken;

            return response()->json([
                'token' => $token,
                'user' => auth()->user()
            ], 201);
        } else {
            return response()->json(['error' => 'Incorrect credentials']);
        }
    }

    public function logout()
    {
        $token = auth()->user()->token();
        $token->revoke();
        return response()->json(['success' => 'Logout successful']);
    }
}
