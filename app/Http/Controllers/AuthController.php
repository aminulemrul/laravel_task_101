<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            $account_active = $user->status;
            if ($account_active) {
                $token = auth()->setTTL(525600)->attempt($credentials);
                return $this->respondWithToken($token);
            } else {
                return response()->json('inactive');
            }
        }

        return response()->json('error');
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = User::with(['role'])->where('id', auth()->user()->id)->first();

        return response()->json($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'admin_access_token' => $token,
            'token_type' => 'bearer',
            'admin_data' => auth()->user(),
            'expires_in' => auth()->factory()->getTTL()

        ]);
    }
}
