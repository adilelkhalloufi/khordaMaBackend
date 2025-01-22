<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavarisController extends Controller
{
 
    public function __invoke(Request $request)
    {
        $user = auth()->user();

        $user->favorites()->attach(request('product_id'));

        return response()->json([
            'message' => 'Product added to favaris'
        ]);

    }
}
