<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
  public function store(Request $request)
  {
    // sanitize data
    if (!Auth::attempt($request->only(['email', 'password']))) {
      return response()->json(['message' => 'incorrect credentials']);
    }

    $token = $request->user()->createToken('Secure Token')->accessToken;

    return response()->json(['token' => $token]);
  }

  public function destroy()
  {
    auth()->user()->token()->revoke();

    return  response()->json(['message' => 'User logged out']);
  }
}
