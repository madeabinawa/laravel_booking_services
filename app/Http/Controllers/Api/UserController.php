<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Customer;
use Exception;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class UserController extends Controller
{
    /*
     * Customer Controller Api
     */

    // User Login & Issuing Token Api
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            // GET LOGIN CREDENTIALS REQUEST
            $login = request(['email', 'password']);

            // IF LOGIN CREDENTIALS DOESNT MATCH IN DATABASE
            if (!Auth::attempt($login)) {
                return ApiResponse::error([], 'Unauthorized', 401);
            }

            // GET USER DATA BY EMAIL
            $user = User::where('email', $login['email'])->first();

            // CHECK USER HASHED PASSWORD
            if (!Hash::check($login['password'], $user->password)) {
                return ApiResponse::error([], 'Invalid Login Credentials', 401);
            }

            // IF USER IS AUTHENTICATED, CREATE NEW TOKEN
            $token = $user->createToken('authToken')->plainTextToken;

            return ApiResponse::success(['token' => $token, 'token_type' => 'Bearer', 'user' => $user], 'Successfully Logged In');
        } catch (Exception $e) {
            return ApiResponse::error(['error' => $e], 'Something Went Wrong');
        }
    }

    // GET USER DETAILS
    public function show()
    {
        // GET USER DETAIL WITH ID
        $user = User::find(Auth::id());

        return ApiResponse::success($user, 'Successfully fetch data');
    }

    public function update(Request $request)
    {
        // VALIDATE REQUEST
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
        ]);

        try {
            // GET USER DETAIL WITH ID
            $user = User::find(Auth::id());
            $customer = Customer::find($user->profile->id);

            // UPDATE CUSTOMER FIELD
            $customer->update([
                'name' => $request['name'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'city' => $request['city'],
            ]);

            // CHECK IF REQUEST INCLUDE PASSWORD
            // THEN UPDATE USER PASSWORD
            if ($request['password']) {
                if (!Hash::check($request['password'], $user->password)) {
                    $user->update(Hash::make($request['password']));
                }
            }

            return ApiResponse::success(['user' => $user], 'Successfully update user');
        } catch (Exception $e) {
            return  ApiResponse::error($e, 'Something went wrong');
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }
}
