<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   public function __construct()
    {
        parent::__construct();

        $this->middleware('auth:api', ['except' => ['login']]);
        $this->middleware('guest:api', ['only' => ['login']]);
    }

    /**
     * POST
     * /api/login
     * 
     * Example:
     *  {
     *      "email": "admin5@restapi.test",
     *      "password": "password"
     *  }
     */

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $token = auth()->attempt($credentials);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['success' => false], 401);
        }

        if (!auth()->user()->isActive()) {
            return response()->json(['success' => false], 412);
        }

        return response()
            ->json([
                'success'    => true,
                'token'      => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ], 200);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        $logout = auth()->logout();

        return response()->json(['success' => true], 200);
    }

    public function refresh()
    {
        $token = auth()->refresh();

        return response()
            ->json([
                'success'    => true,
                'token'      => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ], 200);
    }
}
