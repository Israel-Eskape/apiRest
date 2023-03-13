<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HotelReservation
 * 
 * @property int $id
 * @property string $description
 * @property Carbon $arrival
 * @property Carbon $departure
 * @property int $amountPeople
 * @property int $hotelRoom_id
 * @property int $hotelCheckIn_id
 * @property int $hotelCheckOut_id
 * @property int $hotelReservationStatu_id
 * @property int $hotelPay_id
 * @property int $hotelStatusEntity_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HotelCheckIn $hotel_check_in
 * @property HotelCheckOut $hotel_check_out
 * @property HotelPay $hotel_pay
 * @property HotelReservationStatus $hotel_reservation_status
 * @property HotelRoom $hotel_room
 * @property HotelStatusEntity $hotel_status_entity
 * @property Collection|HotelCancellation[] $hotel_cancellations
 * @property Collection|HotelCustomer[] $hotel_customers
 *
 * @package App\Models
 */
class HotelReservation extends Model
{
	protected $table = 'hotelReservations';

	protected $casts = [
		'hotelUser_id'=>'int',
		'amountPeople' => 'int',
		'hotelRoom_id' => 'int',
		'hotelCheckIn_id' => 'int',
		'hotelCheckOut_id' => 'int',
		'hotelReservationStatu_id' => 'int',
		'hotelPay_id' => 'int',
		'hotelStatusEntity_id' => 'int'
	];

	protected $dates = [
		'arrival',
		'departure'
	];

	protected $fillable = [
		'description',
		'arrival',
		'departure',
		'amountPeople',
		'hotelUser_id',
		'hotelRoom_id',
		'hotelReservationStatu_id',
		
		'hotelStatusEntity_id'
	];

	public function hotel_check_in()
	{
		return $this->belongsTo(HotelCheckIn::class);
	}

	public function hotel_check_out()
	{
		return $this->belongsTo(HotelCheckOut::class);
	}

	public function hotel_pay()
	{
		return $this->belongsTo(HotelPay::class);
	}

	public function hotel_reservation_status()
	{
		return $this->belongsTo(HotelReservationStatus::class, 'hotelReservationStatu_id');
	}

	public function hotel_room()
	{
		return $this->belongsTo(HotelRoom::class);
	}

	public function hotel_status_entity()
	{
		return $this->belongsTo(HotelStatusEntity::class);
	}

	public function hotel_cancellations()
	{
		return $this->hasMany(HotelCancellation::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
}
