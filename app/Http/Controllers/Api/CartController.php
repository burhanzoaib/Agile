<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function addTocart(Request $request)
    {

        $data=[
            'user_id'=>$request->user_id,
            'activity_type'=>$request->activity_type,
            'activity_id'=>$request->activity_id,
            'no_of_travellers'=>$request->no_of_travellers,
            'date'=>$request->date,
            'start_time'=>$request->start_time,
            'time_id'=>$request->time_id,

        ];
        Cart::create($data);

        return response()->json(['message' => 'Activity added to Cart']);

    }

    public function getCartItems($userId)
    {

        $cart = Cart::with('cityTour', 'rating','attraction', 'adventure','viptransportation','transportation')
            ->where('user_id', $userId)
            ->get();


        if ($cart->isEmpty()) {
            return response()->json(['message' => 'No  item found in the cart.'], 404);
        }

        // Now, based on the activity_type, you can access the related data
        $cartData = $cart->map(function ($item) {
            if ($item->activity_type === 'CityTour') {
                $data['cart_item']=$item->id;
                $data['no_of_travellers']=$item->no_of_travellers;
                $data['date']=$item->date;
                $data['start_time']=$item->start_time;
                $data['time_id']=$item->time_id;
                $data['city']=$item->cityTour;

                return $data;
            } elseif ($item->activity_type === 'Attraction') {
                $data['cart_item']=$item->id;
                $data['no_of_travellers']=$item->no_of_travellers;
                $data['date']=$item->date;
                $data['start_time']=$item->start_time;
                $data['time_id']=$item->time_id;
                $data['attraction']=$item->attraction;
                return $data;
            } elseif ($item->activity_type === 'Adventure') {
                $data['cart_item']=$item->id;
                $data['no_of_travellers']=$item->no_of_travellers;
                $data['date']=$item->date;
                $data['start_time']=$item->start_time;
                $data['time_id']=$item->time_id;
                $data['adventure']=$item->adventure;
                return $data;
            } elseif ($item->activity_type === 'viptransportation') {
                $data['cart_item']=$item->id;
                $data['no_of_travellers']=$item->no_of_travellers;
                $data['date']=$item->date;
                $data['start_time']=$item->start_time;
                $data['time_id']=$item->time_id;
                $data['viptransportation']=$item->viptransportation;
                return $data;


            }
            elseif ($item->activity_type === 'Transportation') {
                $data['cart_item']=$item->id;
                $data['no_of_travellers']=$item->no_of_travellers;
                $data['date']=$item->date;
                $data['start_time']=$item->start_time;
                $data['time_id']=$item->time_id;
                $data['transportation']=$item->transportation;
                return $data;


            }



            return null;
        });

        return response()->json($cartData);
    }



    public function deleteCartItem($cartItemId)
    {

        $cartItem = Cart::find($cartItemId);

        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found.'], 404);
        }
        $cartItem->delete();

        return response()->json(['message' => 'Cart Item deleted successfully.']);
    }



}
