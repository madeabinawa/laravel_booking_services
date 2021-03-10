<?php

namespace App\Http\Controllers;

use App\Models\Assistant;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AssistantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('profile_type', 'LIKE', '%Assistant')->paginate(3);
        return view('assistants.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assistants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDATE CREATE CUSTOMER REQUEST
        $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8|',
            'phone' => 'required|min:10',
            'city' => 'required|max:200',
        ]);

        // CREATE CUSTOMER DETAIL IN CUSTOMERS TABLE
        $profile = Assistant::create([
            'name' => $request['name'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'city' => $request['city'],
            'priority' => $request['priority'],
            'manager_id' => $request['manager_id'],
        ]);

        // CREATE CUSTOMER CREDENTIALS IN USERS TABLE
        $user = User::create([
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        //CREATE CUSTOMER TABLE RELATIONSHIP TO USER TABLE WITH ID
        $profile->user()->save(User::find($user->id));

        return redirect()->route('assistants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assistant  $assistant
     * @return \Illuminate\Http\Response
     */
    public function show(Assistant $assistant)
    {
        $AssistantDetail = Assistant::find($assistant->id);
        return view('assistants.show', compact('AssistantDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assistant  $assistant
     * @return \Illuminate\Http\Response
     */
    public function edit(Assistant $assistant)
    {
        $data = Assistant::find($assistant->id);
        return view('assistants.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assistant  $assistant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assistant $assistant)
    {
        // GET USER ATTRIBUTES
        $user = $assistant->user;

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

        // CUSTOMERS TABLE RELATED UPDATE
        Assistant::where('id', $assistant->id)
            ->update([
                'name' => $request['name'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'city' => $request['city'],
                'manager_id' => $request['manager_id']
            ]);

        return redirect()->route('assistants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assistant  $assistant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assistant $assistant)
    {
        // SET CUSTOMER ASSISTANT ID WITH NULL
        Customer::where('assistant_id', $assistant->id)
            ->update(['assistant_id' => NULL]);

        $uid = $assistant->user->id;

        // Delete Customer
        $assistant->delete();

        // Delete in User table
        User::destroy($uid);

        return redirect()->route('assistants.index');
    }
}
