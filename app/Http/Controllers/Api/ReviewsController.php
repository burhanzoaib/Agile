<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;


class ReviewsController extends Controller
{
    public function storeReviews(Request $request)
    {
        $data=[
            'activity_type' => $request->activity_type,
            'activity_id' => $request->activity_id,
            'user_id' =>$request->user_id,
            'review' =>$request->review,
            'rating' => $request->rating,
            'guidance' => $request->guidance,
            'transportation' => $request->transportation,
            'value_money' => $request->value_money,
            'services' => $request->services,
        ];
        Review::create($data);

        return response()->json(['message' => 'Review created successfully',  'thankyou_message' => 'Thanks for the review!'], 201);
    }
    public function getReviews($activity_type, $activity_id)
    {
        // Retrieve reviews based on activity_type and activity_id
        $reviews = Review::with('user')->where('activity_type', $activity_type)
            ->where('activity_id', $activity_id)
            ->get();

        if ($reviews->isEmpty()) {
            return response()->json(['message' => 'No reviews found for the specified activity.'], 404);
        }

        // Calculate rating counts
        $ratingCounts = $reviews->groupBy('rating')
            ->map(function ($group) {
                return $group->count();
            });

        // Extract only the ratings from the $ratingCounts array
        $ratings = $ratingCounts->keys()->toArray();

        return response()->json(['reviews' => $reviews, 'ratings' => $ratings, 'count' => count($reviews)], 200);
    }

    public function reviewsbyrating($activity_type,$activity_id,$rating){
        $rating=Review::where(['rating'=>$rating,'activity_type'=>$activity_type,'activity_id'=>$activity_id])->get();
        return $rating;
    }

}
