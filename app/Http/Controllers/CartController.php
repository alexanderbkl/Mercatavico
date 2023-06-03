<?php

namespace App\Http\Controllers;

use App\Helpers\CartHelper;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class CartController extends Controller
{
    

    public function index()
    {
        $cartItems = Auth::user()->cartItems;
        $totalAmount = CartHelper::calcTotalAmount();
        return view('cart.buy', compact('cartItems', 'totalAmount'));
    }


    public function getProducts(Request $request)
    {

        try {
            $productIds = $request->get('product_ids');
            $products = Product::whereIn('id', $productIds)->get();
            return response()->json($products);
        } catch (Exception $e) {
            // Log the error
            Log::error($e);
            // Respond with an error message
            return response()->json(['error' => 'An error occurred while getting the products: ', $e], 500);
        }

    }
    }