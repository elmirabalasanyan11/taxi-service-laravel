<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthday',
        'car_id',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // user types
    const DRIVER = 'driver';
    const ADMIN = 'admin';
    const USER = 'user';

    public function car()
    {
        return $this->hasOne(Car::class, 'id', 'car_id');
    }

    public function driverLicense()
    {
        return $this->hasOne(DriverLicense::class);
    }

    public static function getDrivers()
    {
        return self::where('type', self::DRIVER)->get();
    }

    public static function getDriver($id)
    {
        return self::where('id', $id)
            ->where('type', self::DRIVER)
            ->first();
    }
}
