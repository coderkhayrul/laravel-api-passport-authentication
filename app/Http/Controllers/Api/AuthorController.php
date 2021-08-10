<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

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
    public function lgoin(Request $request)
    {
    }

    // PROFILE METHORD - GET
    public function profile()
    {
    }

    // LOGOUT METHORD - GET
    public function logout()
    {
    }
}
