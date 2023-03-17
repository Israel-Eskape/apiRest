<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
		'hotelStatusEntity_id'
    ];

    protected $dates = [
		'birthday',
	];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'hotelRole_id',
		'hotelStatusEntity_id',
        "email_verified_at",
        "created_at",
        "updated_at",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'hotelRole_id' => 'int',
		'hotelStatusEntity_id' => 'int'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function hotelRole()
	{
		return $this->belongsTo(HotelRole::class);
	}

	public function hotelStatusEntity()
	{
		return $this->belongsTo(HotelStatusEntity::class);
	}
    public function hotelReservation()
    {
        return $this->hasMany(hotelReservation::class);
    }

}
