<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use HasFactory;

    protected $fillable = [ "name", "min_cost", "cost_per_minute", "cost_per_km", "free_km_count", "free_minutes_count"];

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_tariffs');
    }

    public static function getById($id)
    {
        return self::where('id', $id)->first();
    }

}
