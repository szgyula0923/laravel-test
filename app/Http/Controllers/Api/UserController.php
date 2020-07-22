<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth:api');
        $this->middleware('admin:api');
    }

    /**
     * GET
     * /api/users
     * 
     * List all users
     * 
     * Permission: Admin
     * 
     */
    public function index() 
    {
        return response()
            ->json([
                'success' => true,
                'message' => 'ok',
                'data'    => User::paginate(10)
            ], 201);
    }

    /**
     * POST
     * api/users
     * 
     * Save new user
     * 
     * Permission: Admin
     * Example:
     *  {
     *      "first_name": "Gábor",
     *      "last_name": "Kiss",
     *      "fb_link": "facebook.com/me",
     *      "password": "password",
     *      "email": "admin6@restapi.test",
     *      "birth_date": "2000-05-15",
     *      "admin": true,
     *      "active": true
     * }
     */

    public function store(UserRequest $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);

        $request->user()->create($request->all());
        
        return response()
            ->json([
                'success' => true,
                'message' => 'User has been added successfully'
            ], 201);
    }

    /**
     * DELETE
     * api/users/{id}
     * 
     * Delete a user
     * 
     * Permission: Admin
     */

    public function destroy(User $user)
    {
        $user->delete();

        return response()
            ->json([
                'success' => true,
                'message' => 'User has been deleted successfully'
            ], 200);
    }
}
