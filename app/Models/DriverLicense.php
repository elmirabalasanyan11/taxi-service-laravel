<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverLicense extends Model
{
    use HasFactory;

    protected $table = 'driver_license';

    protected $fillable = ['user_id', 'number', 'series', 'expire_date'];
}
