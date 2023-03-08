<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hotelStatusEntity extends Model
{
    use HasFactory;
    protected $table = 'hotelStatusEntitys';

	protected $fillable = [
		'name',
		'description'
	];
	protected $hidden = [
		'created_at',
		'updated_at'
	];
    public function Users()
	{
		return $this->hasMany(User::class);
	}
    public function hotelRoles()
	{
		return $this->hasMany(HotelRole::class);
	}
	
}
