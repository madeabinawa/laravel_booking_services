<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;
use Exception;
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
        // GET USER DETAIL WITH ID
        $user = User::find(Auth::id());

        $appointments = Appointment::where('customer_id', $user->profile->id)->get();
        return ApiResponse::success($appointments, 'successfully fetch data');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $user = User::find(Auth::id());

        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'appointment_date' => 'required',
                'customer_id' => 'required',
                'assistant_id' => 'required',
            ]);

            $appointment = Appointment::create($request->all());
            return ApiResponse::success($appointment, 'Successfully created');
        } catch (Exception $e) {
            return ApiResponse::error($e, 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::find($id);

        if ($appointment) {
            return ApiResponse::success($appointment, 'Successfully fetch data');
        }
        return ApiResponse::error([], 'Error data not found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'appointment_date' => 'required',
            'customer_id' => 'required',
            'assistant_id' => 'required',
        ]);

        try {
            $appointment = Appointment::find($id);
            $appointment->update($request->all());

            return ApiResponse::success($appointment, 'Successfully update data');
        } catch (Exception $e) {
            return ApiResponse::error($e, 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Appointment::destroy($id);
            return ApiResponse::success(null, 'Successfully delete appointment');
        } catch (Exception $e) {
            return ApiResponse::error($e, 'Something went wrong');
        }
    }
}
