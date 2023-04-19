<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
/** */
/**
 * Class HotelHotel
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property int $hoteliidtec_id
 * @property int $hotelStatusEntity_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HotelIidtec $hotel_iidtec
 * @property HotelStatusEntity $hotel_status_entity
 * @property Collection|HotelEmployee[] $hotel_employees
 * @property Collection|HotelRoom[] $hotel_rooms
 *
 * @package App\Models
 */
class HotelHotel extends Model
{
	protected $table = 'hotelHotels';

	protected $casts = [
		'hoteliidtec_id' => 'int',
		'hotelStatusEntity_id' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'address',
		'phone',
		'email',
		'hoteliidtec_id',
		'hotelStatusEntity_id'
	];

	public function hotel_iidtec()
	{
		return $this->belongsTo(HotelIidtec::class, 'hoteliidtec_id');
	}

	public function hotel_status_entity()
	{
		return $this->belongsTo(HotelStatusEntity::class);
	}

	public function hotel_employees()
	{
		return $this->hasMany(HotelEmployee::class);
	}

	public function hotel_rooms()
	{
		return $this->hasMany(HotelRoom::class);
	}
}
