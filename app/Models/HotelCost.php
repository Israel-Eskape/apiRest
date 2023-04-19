<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
/** */
/**
 * Class HotelCost
 * 
 * @property int $id
 * @property float $price
 * @property float $iva
 * @property float $discount
 * @property int $hotelStatusEntity_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HotelStatusEntity $hotel_status_entity
 *
 * @package App\Models
 */
class HotelCost extends Model
{
	protected $table = 'hotelCosts';

	protected $casts = [
		'price' => 'float',
		'iva' => 'float',
		'discount' => 'float',
		'hotelStatusEntity_id' => 'int'
	];

	protected $fillable = [
		'price',
		'iva',
		'discount',
		'hotelStatusEntity_id'
	];

	public function hotel_status_entity()
	{
		return $this->belongsTo(HotelStatusEntity::class);
	}
}
