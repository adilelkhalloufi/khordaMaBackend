<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductRessource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavarisController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favorites = $user->favorites;

        return response()
        ->json(ProductRessource::collection($favorites));
       
    }
    
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $user->favorites()->toggle($request->product_id);

       
        
        return response()->json([
            'message' => 'Product removed from favorites',
        ]);
    }

  
}
