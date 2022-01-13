<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        return CarResource::collection(Car::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarRequest $request)
    {
        $car = Car::create($request->all());

        if (isset($request->tariffs)) {
            $car->tariffs()->sync($request->tariffs, false);
        } else {
            $car->tariffs()->sync(array());
        }

        return response()->json([
            'status' => 'Created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Car $car
     */
    public function show(Car $car)
    {
        return new CarResource($car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Car $car
     */
    public function update(Request $request, Car $car)
    {
        $car->update($request->all());

        if (isset($request->tariffs)) {
            $car->tariffs()->sync($request->tariffs);
        } else {
            $car->tariffs()->sync(array());
        }

        return new CarResource($car);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Car $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->tariffs()->detach();
        $car->delete();

        return response()->json([
            'status' => 'Deleted'
        ]);
    }
}
