<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HotelReservationStatus
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $hotelStatusEntity_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HotelStatusEntity $hotel_status_entity
 * @property Collection|HotelReservation[] $hotel_reservations
 *
 * @package App\Models
 */
class HotelReservationStatus extends Model
{
	protected $table = 'hotelReservationStatus';

	protected $casts = [
		'hotelStatusEntity_id' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'hotelStatusEntity_id'
	];

	public function hotel_status_entity()
	{
		return $this->belongsTo(HotelStatusEntity::class);
	}

	public function hotel_reservations()
	{
		return $this->hasMany(HotelReservation::class, 'hotelReservationStatu_id');
	}
}
