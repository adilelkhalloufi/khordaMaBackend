<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavarisController extends Controller
{
    public function __invoke(Request $request)
    {

        $user = Auth::user();
        
        $user->favorites()->toggle($request->product_id);

       
        
        return response()->json([
            'message' => 'Product removed from favorites',
        ]);

    }
}
