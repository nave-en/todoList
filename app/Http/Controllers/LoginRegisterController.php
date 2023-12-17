<?php

namespace App\Http\Controllers;

use App\Models\ListTable;
use App\Models\UsersTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginRegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|min:8',
            'email' => 'email:rfc,dns|required|unique:users',
            'dob' => 'date'
        ]);

        if ($validator->fails()) {
            echo "failed";
            return;
        }
        if (!(new UsersTable())->register($request)) {
            return "User successfully created";
        }
        
        return "success";

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        $userDetails = UsersTable::select('email', 'password')
            ->where('email', $request->input('email'))
            ->first();
        if (empty($userDetails)) {
            return response()->json([
                'status' => false,
                'message' => 'email  not found.'
            ]);
        }

        if (!Hash::check($request->input('password'), $userDetails->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Incorrect password.'
            ]);
        }
        
        return "successfully logged in.";
    }

    public function getUserDetails(Request $request)
    {
        $requestData = $request->all();
        return response()->json(
            UsersTable::with('list')->where('users.id', 1)->first()
        );
    }
}
