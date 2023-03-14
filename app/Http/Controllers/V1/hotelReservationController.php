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
     // Update a reservation
     public function update(Request $request, $id)
     {
         $reservation = hotelReservation::find($id);
         //return $id;
         if (!$reservation) {
             return response()->json(['error' => 'Reservation not found'], 404);
         }
 
         $data = $request->all();

            $validator = Validator::make($data, [
            'hotelUser_id' => 'numeric',
            'description' => 'string',
            'arrival' => 'date',
            'departure' => 'date',
            'amountPeople'=>'numeric',
            'hotelRoom_id'=>'numeric',
            'hotelReservationStatu_id'=>'numeric',
            'hotelStatusEntity_id'=>'numeric'

        ]);
 
         if ($validator->fails()) {
             return response()->json(['error' => $validator->errors()], 400);
         }
 
         if ($request->has('hotelUser_id')) {
             $reservation->hotelUser_id = $request->hotelUser_id;
         }
 
         if ($request->has('description')) {
             $reservation->description = $request->description;
         }
 
         if ($request->has('arrival')) {
             $reservation->arrival = $request->arrival;
         }
 
         if ($request->has('departure')) {
             $reservation->departure = $request->departure;
         }

         if ($request->has('amountPeople')) {
            $reservation->amountPeople = $request->amountPeople;
        }

        if ($request->has('hotelRoom_id')) {
            $reservation->hotelRoom_id = $request->hotelRoom_id;
        }

        if ($request->has('hotelReservationStatu_id')) {
            $reservation->hotelReservationStatu_id = $request->hotelReservationStatu_id;
        }

        if ($request->has('hotelStatusEntity_id')) {
            $reservation->hotelStatusEntity_id = $request->hotelStatusEntity_id;
        }

 
         $reservation->save();
 
         return response()->json(['data' => $reservation], 200);
     }

    /**
     * Remove the specified resource from storage.
     */
     // Delete a reservation
     public function destroy($id)
     {
         $reservation = hotelReservation::find($id);
         if (!$reservation) {
             return response()->json(['error' => 'Reservation not found'], 404);
         }
         $reservation->delete();
         return response()->json(['message' => 'Reservation deleted'], 200);
     }
}
