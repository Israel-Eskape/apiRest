<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HotelPay
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $hotelStatusEntity_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HotelStatusEntity $hotel_status_entity
 *
 * @package App\Models
 */
class HotelPay extends Model
{
	protected $table = 'hotelPays';

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
}
