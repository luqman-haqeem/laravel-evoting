<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User as User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors());
        // }

        // $user = User::create([
        //     'name' => $request->name,
        //     'last_name' => 'test',
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password)
        // ]);

        // $token = $user->createToken('auth_token')->plainTextToken;

        $user = new User;
     $user->name = 'joe';
     $user->last_name = 'joe';
     $user->email = 'joe@gmail.com';
     $user->password = Hash::make('123456');

     if ( ! ($user->save()))
     {
         dd('user is not being saved to database properly - this is the problem');          
     }

     if ( ! (Hash::check('123456', Hash::make('123456'))))
     {
         dd('hashing of password is not working correctly - this is the problem');          
     }

     if ( ! (Auth::attempt(array('email' => 'joe@gmail.com', 'password' => '123456'))))
     {
         dd('storage of user password is not working correctly - this is the problem');          
     }

     else
     {
         dd('everything is working when the correct data is supplied - so the problem is related to your forms and the data being passed to the function');
     }

        return response()
            ->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer',]);
    }
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['message' => 'Hi ' . $user->name . ', welcome to home', 'access_token' => $token, 'token_type' => 'Bearer',]);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
