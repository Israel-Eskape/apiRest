<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HotelPoll
 * 
 * @property int $id
 * @property string $comments
 * @property string $satisfaction
 * @property int $hotelStatusEntity_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property HotelStatusEntity $hotel_status_entity
 * @property Collection|HotelCheckOut[] $hotel_check_outs
 *
 * @package App\Models
 */
class HotelPoll extends Model
{
	protected $table = 'hotelPolls';

	protected $casts = [
		'hotelStatusEntity_id' => 'int'
	];

	protected $fillable = [
		'comments',
		'satisfaction',
		'hotelStatusEntity_id'
	];

	public function hotel_status_entity()
	{
		return $this->belongsTo(HotelStatusEntity::class);
	}

	public function hotel_check_outs()
	{
		return $this->hasMany(HotelCheckOut::class);
	}
}
