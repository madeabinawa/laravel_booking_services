<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('profile_type', 'LIKE', '%Admin')->paginate(3);
        return view('admins.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDATE CREATE MANAGER REQUEST
        $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8|',
        ]);

        // CREATE MANAGER DETAIL IN CUSTOMERS TABLE
        $profile = Admin::create([
            'name' => $request['name'],
        ]);

        // CREATE CUSTOMER CREDENTIALS IN USERS TABLE
        $user = User::create([
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        //CREATE CUSTOMER TABLE RELATIONSHIP TO USER TABLE WITH ID
        $profile->user()->save(User::find($user->id));

        return redirect()->route('admins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        $AdminDetail = Admin::find($admin->id);
        return view(' admins.show', compact('AdminDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $data = Admin::find($admin->id);
        return view('admins.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        // GET USER ATTRIBUTES
        $user = $admin->user;

        // CHECK IF USER UPDATE THE PASSWORD
        if ($request['password']) {
            $request->validate(
                [
                    'password' => 'min:8|confirmed'
                ]
            );

            if (!Hash::check($request['password'], $user->password)) {
                $newPassword = Hash::make($request['password']);
            }

            // USERS TABLE RELATED UPDATE
            User::where('id', $user->id)
                ->update([
                    'password' => $newPassword
                ]);
        }

        // MANAGERS TABLE RELATED UPDATE
        Admin::where('id', $admin->id)
            ->update([
                'name' => $request['name'],
            ]);

        return redirect()->route('admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        // GET ADMIN USER ID
        $uid = $admin->user->id;

        // Delete ADMIN
        $admin->delete();

        // Delete User IN USER TABLE
        User::destroy($uid);

        return redirect()->route('admins.index');
    }
}
