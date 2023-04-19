<?php
use App\Http\Controllers\V1\ProductsController;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\hotelStatusEntityController;
use App\Http\Controllers\V1\hotelReservationController;
use App\Http\Controllers\V1\hotelHotelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function () {
    //Prefijo V1, todo lo que este dentro de este grupo se accedera escribiendo v1 en el navegador, es decir /api/v1/*
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::post('register', [AuthController::class, 'register']); 
    Route::get('statusEntity',[hotelStatusEntityController::class,'index']);
    Route::get('hotels',[hotelHotelController::class,'index']);
    
    Route::get('hotel/{id}', [hotelHotelController::class, 'show']);
  
    Route::get('checkAvailability/{room_id}/{start_data}/{end_data}',[hotelReservationController::class,'checkAvailability']);
    
    Route::group(['middleware' => ['jwt.verify']], function() {
        //Todo lo que este dentro de este grupo requiere verificación de usuario.
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user/{id}', [AuthController::class, 'show']);
        Route::get('getUsers', [AuthController::class, 'index']);
        Route::post('update/{id}', [AuthController::class, 'update']);

        Route::get('reservation',[hotelReservationController::class, 'index']);
        Route::get('reservation/{id}',[hotelReservationController::class, 'show']);
        Route::post('reservation',[hotelReservationController::class, 'store']);
        Route::post('update-reservation/{id}',[hotelReservationController::class,'update']);
        Route::get('userReservation/{id}',[hotelReservationController::class, 'showUserReservation']);
             
    });
});