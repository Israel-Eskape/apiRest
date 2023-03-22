<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HotelCancellation
 * 
 * @property int $id
 * @property string $reason
 * @property float $refound
 * @property int $hotelReservation_id
 * @property int $hotelStatusEntity_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HotelReservation $hotel_reservation
 * @property HotelStatusEntity $hotel_status_entity
 *
 * @package App\Models
 */
class HotelCancellation extends Model
{
	protected $table = 'hotelCancellations';

	protected $casts = [
		'hotelReservation_id' => 'int',
		'hotelStatusEntity_id' => 'int'
	];

	protected $fillable = [
		'reason',
		'hotelReservation_id',
		'hotelStatusEntity_id'
	];

	public function hotel_reservation()
	{
		return $this->belongsTo(HotelReservation::class);
	}

	public function hotel_status_entity()
	{
		return $this->belongsTo(HotelStatusEntity::class);
	}
}