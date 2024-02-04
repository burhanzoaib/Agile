<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PromoCode;


class PromoCodeController extends Controller
{
   
    public function validateCode(Request $request)
{
    
    $promoCode = PromoCode::where('coupon_code', $request->coupon_code)->first();
  
    if (!$promoCode) {
        
        return response(['message' => 'coupin code is not valid'], 404);
    }

    
    $discount = $promoCode->discount;

    return response(['message' => 'Valid promo code', 'promo_code_data' => $promoCode], 200);
}

}
