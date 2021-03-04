<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('profile_type', 'LIKE', '%Customer')->paginate(10);
        return view('customers.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
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
            'priority' => 'required|',
        ]);

        // CREATE CUSTOMER CREDENTIALS IN USERS TABLE
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        // CREATE CUSTOMER DETAIL IN CUSTOMERS TABLE
        $profile = Customer::create([
            'phone' => $request['phone'],
            'address' => $request['address'],
            'city' => $request['city'],
            'priority' => $request['priority'],
            'assistant_id',
        ]);

        //CREATE CUSTOMER TABLE RELATIONSHIP TO USER TABLE WITH ID
        $profile->user()->save(User::find($user->id));

        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $CustomerDetail = Customer::find($customer->id);
        return view('customers.show', compact('CustomerDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $data = Customer::find($customer->id);
        return view('customers.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        // GET USER ATTRIBUTES
        $user = $customer->user;

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
                    'name' => $request['name'],
                    'password' => $newPassword
                ]);
        }

        // USERS TABLE RELATED UPDATE
        User::where('id', $user->id)
            ->update([
                'name' => $request['name'],
            ]);

        // CUSTOMERS TABLE RELATED UPDATE
        Customer::where('id', $customer->id)
            ->update([
                'phone' => $request['phone'],
                'address' => $request['address'],
                'city' => $request['city'],
                'priority' => $request['priority']
            ]);

        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        // Get User ID
        $uid = $customer->user->id;

        // Delete Customer
        $customer->delete();

        // Delete in User table
        User::destroy($uid);

        return redirect()->route('customers.index');
    }
}
