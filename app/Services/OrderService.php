<?php


namespace App\Services;


use App\Models\Order;
use App\Models\Tariff;
use Illuminate\Http\Request;

class OrderService
{
    /**
     * @param Request $request
     * @param OSRMApiService $OSRMApiService
     * @return mixed
     */
    public function createOrder(Request $request, OSRMApiService $OSRMApiService)
    {
        //get tariff from request
        $tariff = Tariff::getById($request->tariff_id);

        //get tariff's data from chosen tariff
        $minCost = $tariff->min_cost;
        $freeMinutesCount = $tariff->free_minutes_count;
        $freeKmsCount = $tariff->free_km_count;
        $costPerKm = $tariff->cost_per_km;
        $costPerMinute = $tariff->cost_per_minute;

        //get locations from request
        $fromX = $request->from_coordinate_x;
        $fromY = $request->from_coordinate_y;
        $toX = $request->to_coordinate_x;
        $toY = $request->to_coordinate_y;
        $fromAddress = $request->from_address;
        $toAddress = $request->to_address;

        //get data from api
        $totalKms = $OSRMApiService->getDistance($fromX, $fromY, $toX, $toY);
        $totalMinutes = $OSRMApiService->getDuration($fromX, $fromY, $toX, $toY);
        $costByKm = $costPerKm * $totalKms;
        $costByMinutes = $costPerMinute * $totalMinutes;

        //calculate final cost
        $finalCost = $this->calculateCost($minCost, $totalMinutes, $freeMinutesCount, $totalKms, $freeKmsCount, $costPerMinute, $costPerKm);

        if(!$totalKms || !$totalMinutes){
            return false;
        }

        //create an order according to the all data above
        return Order::create([
            'from_address' => $fromAddress ?? '',
            'to_address' => $toAddress ?? '',
            'from_coordinate_x' => $fromX ?? '',
            'from_coordinate_y' => $fromY ?? '',
            'to_coordinate_x' => $toX,
            'to_coordinate_y' => $toY,
            'min_cost' => $minCost,
            'cost_by_km' => $costByKm,
            'cost_by_minutes' => $costByMinutes,
            'final_cost' => $finalCost,
            'status' => Order::NEW_ORDER
        ]);
    }

    /**
     * @param $minCost
     * @param $totalMinutes
     * @param $freeMinutesCount
     * @param $totalKms
     * @param $freeKmsCount
     * @param $costPerMinute
     * @param $costPerKm
     * @return float|int
     */
    protected function calculateCost($minCost, $totalMinutes, $freeMinutesCount,
                                     $totalKms, $freeKmsCount, $costPerMinute, $costPerKm)
    {
        return $minCost + (($totalMinutes - $freeMinutesCount) * $costPerMinute) + (($totalKms + $freeKmsCount) * $costPerKm);
    }
}
