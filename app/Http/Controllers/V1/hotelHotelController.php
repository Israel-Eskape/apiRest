<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\hotelHotel;
use Illuminate\Support\Facades\DB;

class hotelHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getHotelesAleatorios()
    {

        $hoteles = hotelHotel::inRandomOrder()->limit(3)->get();
        return $this->sendResponse($hoteles,'hoteles');
        //return response()->json($hoteles);
    }
    public function index()
    {
        //
        try {
//            $hoteles = hotelHotel::all();
            $hoteles = hotelHotel::where('hotelStatusEntity_id', 1)->get();
            /*foreach ($hoteles as $hotel) {
                $hotel->imagen = base64_encode($hotel->imagen);
            }*/
            return $this->sendResponse($hoteles,'hoteles');

        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $hotel = new hotelHotel;
    $hotel->name = $request->input('name');
    $hotel->description = $request->input('description');

    $hotel->imagen = $request->file('imagen')->getContent();
    $hotel->save();

   // return response()->json($hotel);
    return $this->sendResponse($hotel,'hotel ');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $hotelhotel = hotelHotel::findOrfail($id);
            return $this->sendResponse($hotelhotel,'hotelhotel');
           
        } catch (JWTException $exception) {
            //Error chungo
            return $this->sendError('Error : ',Response::HTTP_INTERNAL_SERVER_ERROR,500);
            
        }
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
