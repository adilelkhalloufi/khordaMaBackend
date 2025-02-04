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
        // test validate should have params call products and it array and product should have id
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
        ]);
        // boucle this product to create order for each product
        foreach ($request->products as $product) {
            $order = $this
                ->auth()
                ->user()
                ->orders()
                ->create([
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity'] ?? 1,
                ]);
        }

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
