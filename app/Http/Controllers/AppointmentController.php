<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->profile_type == 'App\Models\Admin') {
            $appointments = Appointment::orderBy('appointment_date')->paginate(3);
        } else {
            $appointments = Appointment::where('assistant_id', $user->profile->id)->orderByDesc('status')->orderBy('appointment_date')->paginate(3);
        }

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('appointments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'appointment_date' => 'required',
            'customer_id' => 'required',
            'assistant_id' => 'required',
            'status' => 'required'
        ]);

        Appointment::create($request->all());

        return redirect()->route('appointments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        $AppointmentDetail = Appointment::find($appointment->id);
        return view('appointments.show', compact('AppointmentDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        $data = Appointment::find($appointment->id);
        return view('appointments.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'appointment_date' => 'required',
            'status' => 'required'
        ]);

        $appointment->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'appointment_date' => $request['appointment_date'],
            'status' => $request['status'],
        ]);

        return redirect()->route('appointments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index');
    }
}
