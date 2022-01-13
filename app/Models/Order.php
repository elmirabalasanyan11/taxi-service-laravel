<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['from_address', 'to_address', 'from_coordinate_x', 'from_coordinate_y',
        'to_coordinate_x', 'to_coordinate_y', 'min_cost', 'cost_by_km', 'cost_by_minutes', 'final_cost', 'status'];

    //order statuses
    const NEW_ORDER = 'new';
    const IN_ACTION = 'in_action';
    const DECLINED = 'declined';
    const COMPLETED = 'completed';
}
