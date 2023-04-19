<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
/** */
/**
 * Class HotelEmployee
 * 
 * @property int $id
 * @property string $rfc
 * @property int $user_id
 * @property int $hotelHotel_id
 * @property int $hotelStatusEntity_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HotelHotel $hotel_hotel
 * @property HotelStatusEntity $hotel_status_entity
 * @property User $user
 *
 * @package App\Models
 */
class HotelEmployee extends Model
{
	protected $table = 'hotelEmployees';

	protected $casts = [
		'user_id' => 'int',
		'hotelHotel_id' => 'int',
		'hotelStatusEntity_id' => 'int'
	];

	protected $fillable = [
		'rfc',
		'user_id',
		'hotelHotel_id',
		'hotelStatusEntity_id'
	];

	public function hotel_hotel()
	{
		return $this->belongsTo(HotelHotel::class);
	}

	public function hotel_status_entity()
	{
		return $this->belongsTo(HotelStatusEntity::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
