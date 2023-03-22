<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\hotelCancellation;

class hotelCancellationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$reservation)
    {
        //
        try {
            //code...

            $data = $request->all();

        $reservation = hotelCancellation::create([
            'reason' => $request->reason,
            'hotelReservation_id' => $reservation->id,
            'hotelStatusEntity_id'=> $reservation->hotelStatusEntity_id,
        ]);

        return response()->json(['data' => $reservation], 201);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
