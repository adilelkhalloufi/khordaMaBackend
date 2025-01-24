<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // list order for this user
        $orders = Order::where('user_id', auth()->id())
            ->get();

        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // create new order
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',

        ]);

        $order = $this
            ->auth()
            ->user()
            ->orders()
            ->create($request->validated());

        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // delete order
        $order->delete();

        return response()->json([
            'message' => 'Order deleted successfully',
        ]);
    }
}
