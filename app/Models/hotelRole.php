<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HotelRole
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $hotelStatusEntity_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HotelStatusEntity $hotel_status_entity
 * @property Collection|HotelPeople[] $hotel_peoples
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class HotelRole extends Model
{
	protected $table = 'hotelRoles';

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

	public function hotel_peoples()
	{
		return $this->hasMany(HotelPeople::class);
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
