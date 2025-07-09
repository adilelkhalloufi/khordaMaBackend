<?php

namespace App\Http\Controllers;

use App\enum\ProductAdminStatus;
use App\Http\Resources\ProductRessource;
use App\Models\Product;
use App\Services\CoinService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

     
        $Product = Product::with(['categorie', 'unite'])
        ->where(Product::COL_USER_ID, Auth::id())
        ->orderby(Product::COL_STATUS)
        ->orderby(Product::COL_ID,"desc")
        ->get();

    return response()
        ->json(ProductRessource::collection($Product));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validated = $request->validate([
            Product::COL_NAME => 'required',
            Product::COL_DESCRIPTION => 'required',
            Product::COL_PRICE => 'required',
            Product::COL_QUANTITY => 'required',
            Product::COL_CATEGORIE_ID => 'required',
            Product::COL_UNITE_ID => 'required',
         ]);

         $coinService = new CoinService();
         $user = Auth::user();

         // Check if user has enough coins
         if (!$coinService->hasEnoughCoins($user, $coinService->getProductCreationCost())) {
             return response()->json([
                 'message' => 'Insufficient coins. You need ' . $coinService->getProductCreationCost() . ' coin(s) to create a product.',
                 'required_coins' => $coinService->getProductCreationCost(),
                 'current_coins' => $user->coins
             ], 402); // 402 Payment Required
         }

         try {
             // Deduct coins first
             $coinService->chargeForProductCreation($user);
             
             // Create the product
             $user->products()->create($validated);

             return response()->json([
                 'message' => 'Product created successfully',
                 'coins_deducted' => $coinService->getProductCreationCost(),
                 'remaining_coins' => $coinService->getBalance($user)
             ], 201);

         } catch (\Exception $e) {
             return response()->json([
                 'message' => 'Failed to create product: ' . $e->getMessage()
             ], 500);
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Product = Product::with(['categorie', 'unite'])
            ->where(Product::COL_ID, $id)
            ->first();

        // Get 4 related products from the same category
        $relatedProducts = Product::where(Product::COL_CATEGORIE_ID, $Product->categorie_id)
            ->where(Product::COL_ID, '!=', $id) // Exclude current product
            ->where(Product::COL_AVAILABILITY_STATUS, ProductAdminStatus::Published->value)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        // If no related products found, get 4 random products
        if ($relatedProducts->count() < 4) {
            $relatedProducts = Product::where(Product::COL_ID, '!=', $id) // Exclude current product
                ->where(Product::COL_AVAILABILITY_STATUS, ProductAdminStatus::Published->value)
                ->inRandomOrder()
                ->limit(3)
                ->get();
        }

        // Add related products as an attribute to the main product
        $Product->relatedProducts = $relatedProducts;

        return response()
            ->json(new ProductRessource($Product));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function GetProduct(Request $request)
    {


            $Product = Product::with(['categorie', 'unite'])
            ->where(Product::COL_AVAILABILITY_STATUS, ProductAdminStatus::Published->value)
            ->orderby(Product::COL_STATUS)
            ->get();

        return response()
            ->json(ProductRessource::collection($Product));
    }


    /**
     * Get user's coin balance
     */
    public function getCoinBalance()
    {
        $coinService = new CoinService();
        $user = Auth::user();

        return response()->json([
            'coins' => $coinService->getBalance($user),
            'product_creation_cost' => $coinService->getProductCreationCost()
        ]);
    }
}
