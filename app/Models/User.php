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
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $firstName
 * @property string $lastName
 * @property Carbon $birthday
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property int $hotelRole_id
 * @property int $hotelStatusEntity_id
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HotelRole $hotel_role
 * @property HotelStatusEntity $hotel_status_entity
 * @property Collection|HotelEmployee[] $hotel_employees
 * @property Collection|HotelReservation[] $hotel_reservations
 * @property Collection|IidtecEmployee[] $iidtec_employees
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';

	protected $casts = [
		'birthday' => 'datetime',
		'email_verified_at' => 'datetime',
		'hotelRole_id' => 'int',
		'hotelStatusEntity_id' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'firstName',
		'lastName',
		'birthday',
		'address',
		'phone',
		'email',
		'email_verified_at',
		'password',
		'hotelRole_id',
		'hotelStatusEntity_id',
		'remember_token'
	];

	public function hotel_role()
	{
		return $this->belongsTo(HotelRole::class);
	}

	public function hotel_status_entity()
	{
		return $this->belongsTo(HotelStatusEntity::class);
	}

	public function hotel_employees()
	{
		return $this->hasMany(HotelEmployee::class);
	}

	public function hotel_reservations()
	{
		return $this->hasMany(HotelReservation::class, 'hotelUser_id');
	}

	public function iidtec_employees()
	{
		return $this->hasMany(IidtecEmployee::class);
	}
}
