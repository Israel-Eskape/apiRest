<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IidtecEmployee
 * 
 * @property int $id
 * @property string $rfc
 * @property int $user_id
 * @property int $hotelIidtec_id
 * @property int $hotelStatusEntity_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HotelIidtec $hotel_iidtec
 * @property HotelStatusEntity $hotel_status_entity
 * @property User $user
 *
 * @package App\Models
 */
class IidtecEmployee extends Model
{
	protected $table = 'iidtecEmployees';

	protected $casts = [
		'user_id' => 'int',
		'hotelIidtec_id' => 'int',
		'hotelStatusEntity_id' => 'int'
	];

	protected $fillable = [
		'rfc',
		'user_id',
		'hotelIidtec_id',
		'hotelStatusEntity_id'
	];

	public function hotel_iidtec()
	{
		return $this->belongsTo(HotelIidtec::class);
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
