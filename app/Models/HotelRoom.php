<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HotelRoom
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $available
 * @property float $price
 * @property int $hotelTypeRoom_id
 * @property int $hotelRoomCategory_id
 * @property int $hotelHotel_id
 * @property int $hotelStatusEntity_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HotelHotel $hotel_hotel
 * @property HotelRoomCategory $hotel_room_category
 * @property HotelStatusEntity $hotel_status_entity
 * @property HotelTypeRoom $hotel_type_room
 * @property Collection|HotelReservation[] $hotel_reservations
 *
 * @package App\Models
 */
class HotelRoom extends Model
{
	protected $table = 'hotelRooms';

	protected $casts = [
		'available' => 'int',
		'price' => 'float',
		'hotelTypeRoom_id' => 'int',
		'hotelRoomCategory_id' => 'int',
		'hotelHotel_id' => 'int',
		'hotelStatusEntity_id' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'available',
		'price',
		'hotelTypeRoom_id',
		'hotelRoomCategory_id',
		'hotelHotel_id',
		'hotelStatusEntity_id'
	];

	public function hotel_hotel()
	{
		return $this->belongsTo(HotelHotel::class);
	}

	public function hotel_room_category()
	{
		return $this->belongsTo(HotelRoomCategory::class);
	}

	public function hotel_status_entity()
	{
		return $this->belongsTo(HotelStatusEntity::class);
	}

	public function hotel_type_room()
	{
		return $this->belongsTo(HotelTypeRoom::class);
	}

	public function hotel_reservations()
	{
		return $this->hasMany(HotelReservation::class);
	}
}
