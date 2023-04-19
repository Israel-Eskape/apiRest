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
 * @property int $hotelUser_id
 * @property string $description
 * @property Carbon $arrival
 * @property Carbon $departure
 * @property int $amountPeople
 * @property int $hotelRoom_id
 * @property Carbon|null $checkIn
 * @property Carbon|null $checkOut
 * @property int $hotelReservationStatu_id
 * @property int $hotelStatusEntity_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HotelReservationStatus $hotel_reservation_status
 * @property HotelRoom $hotel_room
 * @property HotelStatusEntity $hotel_status_entity
 * @property User $user
 * @property Collection|HotelCancellation[] $hotel_cancellations
 *
 * @package App\Models
 */
class HotelReservation extends Model
{
	protected $table = 'hotelReservations';

	protected $casts = [
		'hotelUser_id' => 'int',
		'arrival' => 'datetime',
		'departure' => 'datetime',
		'amountPeople' => 'int',
		'hotelRoom_id' => 'int',
		'checkIn' => 'datetime',
		'checkOut' => 'datetime',
		'hotelReservationStatu_id' => 'int',
		'hotelStatusEntity_id' => 'int'
	];

	protected $fillable = [
		'hotelUser_id',
		'description',
		'arrival',
		'departure',
		'amountPeople',
		'hotelRoom_id',
		'checkIn',
		'checkOut',
		'hotelReservationStatu_id',
		'hotelStatusEntity_id'
	];

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

	public function user()
	{
		return $this->belongsTo(User::class, 'hotelUser_id');
	}

	public function hotel_cancellations()
	{
		return $this->hasMany(HotelCancellation::class);
	}
}
