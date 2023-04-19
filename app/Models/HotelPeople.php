<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HotelPeople
 * 
 * @property int $id
 * @property string $name
 * @property string $firstName
 * @property string $lastName
 * @property string $password
 * @property Carbon $birthday
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property int $hotelRole_id
 * @property int $hotelStatusEntity_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HotelRole $hotel_role
 * @property HotelStatusEntity $hotel_status_entity
 * @property Collection|HotelCustomer[] $hotel_customers
 *
 * @package App\Models
 */
class HotelPeople extends Model
{
	protected $table = 'hotelPeoples';

	protected $casts = [
		'birthday' => 'datetime',
		'hotelRole_id' => 'int',
		'hotelStatusEntity_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'firstName',
		'lastName',
		'password',
		'birthday',
		'address',
		'phone',
		'email',
		'hotelRole_id',
		'hotelStatusEntity_id'
	];

	public function hotel_role()
	{
		return $this->belongsTo(HotelRole::class);
	}

	public function hotel_status_entity()
	{
		return $this->belongsTo(HotelStatusEntity::class);
	}

	public function hotel_customers()
	{
		return $this->hasMany(HotelCustomer::class);
	}
}
