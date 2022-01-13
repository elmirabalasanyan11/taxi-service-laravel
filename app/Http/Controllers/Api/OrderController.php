<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use App\Services\OSRMApiService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        return OrderResource::collection(Order::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function store(OrderRequest $request, OrderService $orderService, OSRMApiService $OSRMApiService)
    {
        $order = $orderService->createOrder($request, $OSRMApiService);

        if (!$order) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Order is not created'
            ]);
        }

        return new OrderResource($order);
    }
}
