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
 * Class HotelStatusEntity
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|HotelCancellation[] $hotel_cancellations
 * @property Collection|HotelCheckIn[] $hotel_check_ins
 * @property Collection|HotelCheckOut[] $hotel_check_outs
 * @property Collection|HotelCost[] $hotel_costs
 * @property Collection|HotelCustomer[] $hotel_customers
 * @property Collection|HotelEmployee[] $hotel_employees
 * @property Collection|HotelHotel[] $hotel_hotels
 * @property Collection|HotelIidtec[] $hotel_iidtecs
 * @property Collection|HotelPay[] $hotel_pays
 * @property Collection|HotelPeople[] $hotel_peoples
 * @property Collection|HotelPoll[] $hotel_polls
 * @property Collection|HotelReservation[] $hotel_reservations
 * @property Collection|HotelReservationStatus[] $hotel_reservation_statuses
 * @property Collection|HotelRole[] $hotel_roles
 * @property Collection|HotelRoomCategory[] $hotel_room_categories
 * @property Collection|HotelRoom[] $hotel_rooms
 * @property Collection|HotelTypeRoom[] $hotel_type_rooms
 * @property Collection|IidtecEmployee[] $iidtec_employees
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class HotelStatusEntity extends Model
{
	protected $table = 'hotelStatusEntitys';

	protected $fillable = [
		'name',
		'description'
	];

	public function hotel_cancellations()
	{
		return $this->hasMany(HotelCancellation::class);
	}

	public function hotel_check_ins()
	{
		return $this->hasMany(HotelCheckIn::class);
	}

	public function hotel_check_outs()
	{
		return $this->hasMany(HotelCheckOut::class);
	}

	public function hotel_costs()
	{
		return $this->hasMany(HotelCost::class);
	}

	public function hotel_customers()
	{
		return $this->hasMany(HotelCustomer::class);
	}

	public function hotel_employees()
	{
		return $this->hasMany(HotelEmployee::class);
	}

	public function hotel_hotels()
	{
		return $this->hasMany(HotelHotel::class);
	}

	public function hotel_iidtecs()
	{
		return $this->hasMany(HotelIidtec::class);
	}

	public function hotel_pays()
	{
		return $this->hasMany(HotelPay::class);
	}

	public function hotel_peoples()
	{
		return $this->hasMany(HotelPeople::class);
	}

	public function hotel_polls()
	{
		return $this->hasMany(HotelPoll::class);
	}

	public function hotel_reservations()
	{
		return $this->hasMany(HotelReservation::class);
	}

	public function hotel_reservation_statuses()
	{
		return $this->hasMany(HotelReservationStatus::class);
	}

	public function hotel_roles()
	{
		return $this->hasMany(HotelRole::class);
	}

	public function hotel_room_categories()
	{
		return $this->hasMany(HotelRoomCategory::class);
	}

	public function hotel_rooms()
	{
		return $this->hasMany(HotelRoom::class);
	}

	public function hotel_type_rooms()
	{
		return $this->hasMany(HotelTypeRoom::class);
	}

	public function iidtec_employees()
	{
		return $this->hasMany(IidtecEmployee::class);
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
