<?php

namespace App\Http\Controllers;

use App\Models\Assistant;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('profile_type', 'LIKE', '%Manager')->paginate(3);
        return view('managers.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('managers.create');
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
            'department' => 'required|',
        ]);

        // CREATE MANAGER DETAIL IN CUSTOMERS TABLE
        $profile = Manager::create([
            'name' => $request['name'],
            'department' => $request['department'],
        ]);

        // CREATE CUSTOMER CREDENTIALS IN USERS TABLE
        $user = User::create([
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        //CREATE CUSTOMER TABLE RELATIONSHIP TO USER TABLE WITH ID
        $profile->user()->save(User::find($user->id));

        return redirect()->route('managers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show(Manager $manager)
    {
        $ManagerDetail = Manager::find($manager->id);
        return view('managers.show', compact('ManagerDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(Manager $manager)
    {
        $data = Manager::find($manager->id);
        return view('managers.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manager $manager)
    {
        // GET USER ATTRIBUTES
        $user = $manager->user;

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
        Manager::where('id', $manager->id)
            ->update([
                'name' => $request['name'],
                'department' => $request['department'],
            ]);

        return redirect()->route('managers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manager $manager)
    {
        // SET ASSISTANT ID WITH NULL
        Assistant::where('manager_id', $manager->id)
            ->update(['manager_id' => NULL]);

        // GET MANAGER USER ID
        $uid = $manager->user->id;

        // Delete Customer
        $manager->delete();

        // Delete in User table
        User::destroy($uid);

        return redirect()->route('managers.index');
    }
}
