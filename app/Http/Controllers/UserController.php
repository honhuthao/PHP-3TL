<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index()
    {
        $user = User::all();
        return view('user.index', ['users' => $user]);
    }

    function create(Request $request)
    {
        // validate
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|max:20|confirmed'
        ]);
        if (!$validated) {
            return response()->json(['message' => 'Cannot create user'], 400);
        }
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json(['message' => 'Created user successfully', 'user' => $user], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    function get($id)
    {
        try {
            $user = User::find($id);
            return response()->json($user, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Cannot find user'], 400);
        }
    }

    function delete($id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            return response()->json(['message' => 'Deleted user successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Cannot delete user'], 400);
        }
    }

    function update($id, Request $request)
    {
        //validate
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        if (!$validated) {
            return response()->json(['message' => 'Cannot edit user'], 400);
        }
        try {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->is_active = $request->is_active;
            $user->save();
            return response()->json(['message' => 'Updated user successfully', 'user' => $user], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    function activeUser($id, Request $request)
    {
        try {
            $user = User::find($id);
            $user->is_active = $request->is_active;
            $user->save();
            return response()->json(['message' => 'Active user successfully', 'user' => $user], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }
}