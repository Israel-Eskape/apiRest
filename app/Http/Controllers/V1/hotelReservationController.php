<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\hotelReservation;
use Illuminate\Support\Facades\DB;

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

    //Get a specific user_id
    public function showUserReservation($id){
        try {
            $reservation = DB::table('hotelReservations')
            ->join('hotelReservationStatus', 'hotelReservations.hotelReservationStatu_id', '=', 'hotelReservationStatus.id')
            ->join('hotelRooms', 'hotelReservations.hotelRoom_id', '=', 'hotelRooms.id')
            //->select('users.id', 'users.name', 'roles.name as role', 'departments.name as department')
            ->where('hotelUser_id','like',$id)
            /*->select('hotelReservations.id','hotelReservations.hotelUser_id',
                    'hotelReservations.description','hotelReservations.arrival','hotelReservations.dearture',
                    'hotelReservations.amountPeople','hotelRooms.name')
                    'hotelReservationStatus.name')
            */
            ->select('hotelReservations.id',
                    "hotelReservations.hotelUser_id as User_id",
                    'hotelReservations.description',
                    'hotelReservations.arrival',
                    'hotelReservations.departure',
                    'hotelReservations.amountPeople',
                    'hotelRooms.name as Rooms',
                    'hotelReservationStatus.name as status'
                    )
            ->get();

        return response()->json($reservation);

        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
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
            //'checkIn'=>timestamps(),
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
        if ($request->has('checkOut')) {
            return "Se activa la habitación disponible 1";
        }

        if ($request->has('hotelReservationStatu_id')) {
            if($request->hotelReservationStatu_id == 9){
                $hotelCancellationController = new hotelCancellationController();
                $hotelCancellationController->store($request,$reservation);
                
            }
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
     public function checkAvailability($hotelRoom_id,$arrival,$departure)
{
    $existing_reservation = hotelReservation::where('hotelRoom_id', $hotelRoom_id)
                                        ->where(function ($query) use ($arrival, $departure) {
                                            $query->whereBetween('arrival', [$arrival, $departure])
                                                ->orWhereBetween('departure', [$arrival, $departure])
                                                ->orWhere(function ($query) use ($arrival, $departure) {
                                                    $query->where('arrival', '<', $arrival)
                                                        ->where('departure', '>', $departure);
                                                });
                                        })
                                        ->first();

    if ($existing_reservation) {
        $available_date = date('Y-m-d', strtotime($existing_reservation->departure . ' +1 day'));
        return $this->sendError('Error existing reservation','The room is not available for the selected dates. The next available date is ' . $available_date,401);
        /*return response()->json([
            'status' => 'error',
            'message' => 'The room is not available for the selected dates. The next available date is ' . $available_date
        ]);*/
    } else {
        return $this->sendResponse('succes','The room is available for the selected dates');
        /*return response()->json([
            'status' => 'success',
            'message' => 'The room is available for the selected dates'
        ]);*/
    }
}

}
