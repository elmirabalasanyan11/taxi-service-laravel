<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TariffRequest;
use App\Http\Resources\TariffResource;
use App\Models\Tariff;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return TariffResource::collection(Tariff::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TariffRequest $request)
    {
        Tariff::create($request->all());

        return response()->json([
            'status' => 'Created'
        ]);
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Tariff  $tariff
     */
    public function show(Tariff $tariff)
    {
        return new TariffResource($tariff);
    }


    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tariff  $tariff
     */
    public function update(Request $request, Tariff $tariff)
    {
        $tariff->update($request->all());
        return new TariffResource($tariff);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tariff $tariff)
    {
        $tariff->delete();

        return response()->json([
            'status' => 'Deleted'
        ]);
    }
}
