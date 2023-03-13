<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\hotelReservation;

class hotelReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = hotelReservation::all();
        return response()->json(['data' => $reservations], 200);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    // Create a new reservation
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
            'hotelUser_id' => 'required|numeric',
            'description' => 'required|string',
            'arrival' => 'required|date',
            'departure' => 'required|date',
            'amountPeople'=>'required|numeric',
            'hotelRoom_id'=>'required|numeric',
            'hotelReservationStatu_id'=>'required|numeric',
            'hotelStatusEntity_id'=>'required|numeric'

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(),401);
        }

        $reservation = hotelReservation::create([
            'description' => $request->description,
            'arrival' => $request->arrival,
            'departure' => $request->departure,
            'amountPeople'=>$request->amountPeople,
            'hotelUser_id' => $request->hotelUser_id,
            'hotelRoom_id'=>$request->hotelRoom_id,
            'hotelReservationStatu_id'=>$request->hotelReservationStatu_id,
            'hotelStatusEntity_id'=>$request->hotelStatusEntity_id

        ]);

        return response()->json(['data' => $reservation], 201);
        } catch (\Throwable $th) {
            return $th;
        }
    }
    /**
     * Display the specified resource.
     */
    // Get a specific reservation
    public function show($id)
    {
        $reservation = hotelReservation::find($id);
        if (!$reservation) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }
        return response()->json(['data' => $reservation], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
