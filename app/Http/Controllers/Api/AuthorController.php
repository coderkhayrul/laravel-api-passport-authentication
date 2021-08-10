<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    // REGISTER METHORD - POST
    public function register(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required',
            'email' => 'required |email | unique:authors',
            'phone_no' => 'required',
            'password' => 'required |confirmed'
        ]);

        // Create Data
        $author = new Author();

        $author->name = $request->name;
        $author->email = $request->email;
        $author->phone_no = $request->phone_no;
        $author->password = bcrypt($request->password);
        $author->save();

        // Save Data and send Response
        return response()->json([
            'status' => 1,
            'message' => "Authore Registation Successfully"
        ], 200);
    }

    // LOGIN METHORD - POST
    public function login(Request $request)
    {
        // Validation
        $login_data = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Validated Author Data
        if (!Auth::attempt($login_data)) {
            return response()->json([
                'status' => 0,
                'message' => "invalid Credentials"
            ], 501);
        }

        // token
        $token = Auth::user()->createToken("auth_token")->accessToken;

        // send Response
        return response()->json([
            'status' => 1,
            'message' => "Author Login Successfully",
            'access_token' => $token
        ], 200);
    }

    // PROFILE METHORD - GET
    public function profile()
    {
        $user_data  = Auth::user();

        return response()->json([
            'status' => true,
            'message' => "User Profile data",
            'data' => $user_data
        ]);
    }

    // LOGOUT METHORD - GET
    public function logout()
    {
    }
}
