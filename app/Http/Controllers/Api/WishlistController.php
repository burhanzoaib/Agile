<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {

        $data=[
            'user_id'=>$request->user_id,
            'activity_type'=>$request->activity_type,
            'activity_id'=>$request->activity_id,
        ];
        Wishlist::create($data);
        return response()->json(['message' => 'Activity added to wishlist']);

    }
    public function getWishlist($userId)
    {

        $wishlist = Wishlist::with('cityTour', 'rating','attraction', 'adventure','viptransportation','transportation')
            ->where('user_id', $userId)
            ->get();

//  dd($wishlist);
        if ($wishlist->isEmpty()) {
            return response()->json(['message' => 'No wishlist found for the user.'], 404);
        }
        $wishlistData = $wishlist->map(function ($item) {
            if ($item->activity_type === 'CityTour') {
                $data['item']=$item->id;
                $data['city']=$item->cityTour;
                return $data;
            } elseif ($item->activity_type === 'Attraction') {
                $data['item']=$item->id;
                $data['city']=$item->attraction;
                return $data;
            } elseif ($item->activity_type === 'Adventure') {
                $data['item']=$item->id;
                $data['city']=$item->adventure;
                return $data;
            } elseif ($item->activity_type === 'viptransportation') {
                $data['item']=$item->id;
                $data['city']=$item->viptransportation;
                return $data;
            }elseif ($item->activity_type === 'Transportation') {
                $data['item']=$item->id;
                $data['city']=$item->transportation;
                return $data;
            }



            return null;
        });

        return response()->json($wishlistData);
    }




    public function deleteWishlistItem($wishlistItemId)
    {

        $wishlistItem = Wishlist::find($wishlistItemId);
//dd($wishlistItem);
        if (!$wishlistItem) {
            return response()->json(['message' => 'Wishlist item not found.'], 404);
        }
        $wishlistItem->delete();

        return response()->json(['message' => 'Wishlist item deleted successfully.']);
    }

}
