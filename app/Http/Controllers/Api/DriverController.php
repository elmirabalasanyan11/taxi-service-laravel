<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use App\Http\Resources\DriverResource;
use App\Models\Driver;
use App\Models\DriverLicense;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return DriverResource::collection(User::getDrivers());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //todo validation
        //todo transfer code to services
        $message = 'Created';

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('12345678'),
                'birthday' => $request->birthday,
                'car_id' => $request->car_id,
                'type' => User::DRIVER,
            ]);

            DriverLicense::create([
                'user_id' => $user->id,
                'number' => $request->driver_license_number,
                'series' => $request->driver_license_series,
                'expire_date' => $request->driver_license_expire_date,
            ]);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Error';
        }

        return response()->json([
            'status' => $message
        ]);
    }

    /**
     * Display the specified resource.
     * @param int $id
     */
    public function show($id)
    {
        $driver = User::getDriver($id);

        if (!$driver) {
            return response()->json([
                'status' => 'Driver not found'
            ]);
        } else {
            return new DriverResource($driver);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(DriverRequest $request, $id)
    {
        $driver = User::getDriver($id);

        if ($driver) {
            DB::beginTransaction();

            try {
                $driver->update($request->all());

                if ($driver->driverLicense) {
                    $number = $request->driver_license_number ? $request->driver_license_number : $driver->driverLicense->number;
                    $series = $request->driver_license_series ? $request->driver_license_series : $driver->driverLicense->series;
                    $expireDate = $request->driver_license_expire_date ? $request->driver_license_expire_date : $driver->driverLicense->expire_date;

                    $driver->driverLicense->update([
                        'number' => $number,
                        'series' => $series,
                        'expire_date' => $expireDate,
                        'user_id' => $driver->id
                    ]);

                } else {
                    $number = $request->driver_license_number ?? '';
                    $series = $request->driver_license_series ?? '';
                    $expireDate = $request->driver_license_expire_date ?? '';

                    DriverLicense::create([
                        'number' => $number,
                        'series' => $series,
                        'expire_date' => $expireDate,
                        'user_id' => $driver->id
                    ]);
                }

                DB::commit();

                return new DriverResource($driver);
            } catch (\Exception $e) {
                DB::rollback();
            }
        }

        return \response()->json([
            'message' => 'There is not a driver'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = 'Driver not found';
        $driver = User::getDriver($id);

        if ($driver) {
            $driver->delete();
            $message = 'Deleted';
        }

        return response()->json([
            'status' => $message
        ]);
    }
}
