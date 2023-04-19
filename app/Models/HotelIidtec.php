<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HotelIidtec
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property int $hotelStatusEntity_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HotelStatusEntity $hotel_status_entity
 * @property Collection|HotelHotel[] $hotel_hotels
 * @property Collection|IidtecEmployee[] $iidtec_employees
 *
 * @package App\Models
 */
class HotelIidtec extends Model
{
	protected $table = 'hotelIidtecs';

	protected $casts = [
		'hotelStatusEntity_id' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'address',
		'phone',
		'email',
		'hotelStatusEntity_id'
	];

	public function hotel_status_entity()
	{
		return $this->belongsTo(HotelStatusEntity::class);
	}

	public function hotel_hotels()
	{
		return $this->hasMany(HotelHotel::class, 'hoteliidtec_id');
	}

	public function iidtec_employees()
	{
		return $this->hasMany(IidtecEmployee::class);
	}
}
