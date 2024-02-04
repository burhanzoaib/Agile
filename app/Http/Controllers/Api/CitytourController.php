<?php

namespace App\Http\Controllers\Api;

use App\Mail\BookingEmail;
use App\Mail\secondMail;
use App\Models\Booking;
use App\Models\BookingItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Citytour;
use App\Models\Viptransportation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe;

class CitytourController extends Controller
{
    public function index()
    {
        $tourPackages = Citytour::with(['time' => function ($query) {
            $query->where('package_name', 'citytour');
        },'rating' => function ($query) {
            $query->where('activity_type', 'CityTour');
        }])->get();
        return response()->json(['data' => $tourPackages], 200, [], JSON_PRETTY_PRINT);
    }

    public function vip_transport()
    {
        $viptransportation = Viptransportation::with(['time' => function ($query) {
            $query->where('package_name', 'viptransportation');
        },'rating' => function ($query) {
            $query->where('activity_type', 'viptransportation');
        }])->get();
        // dd($viptransportation);
        return response()->json(['data' => $viptransportation], 200, [], JSON_PRETTY_PRINT);
    }




    public function booking(Request $request){
       // return $request->all();
        DB::beginTransaction();
        if($request->data['payment_method'] == "stripe"){

            Stripe\Stripe::setApiKey('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');
            $statement=Stripe\Charge::create ([
                "amount" => 100 * $request->data['total_price'],
                "currency" => "usd",
                "source" => $request->data['id'],
                "description" => "For ".$request->data['activity_type']." Order" ,
            ]);

            if($statement->captured == 'true') {

                $data = [
                    'customer_name'         =>  $request->data['customer_name'],
                    'customer_email'        =>  $request->data['customer_email'],
//                    'activity_type'         =>  $request->data['activity_type'],
//                    'activity_id'           =>  $request->data['activity_id'],
//                    'date'                  =>  date('d-m-y'),
//                    'quantity'              => $request->data['quantity'],
                    'total_price'           => $request->data['total_price'],
                    'confirmed'             => 0,
                    'notes'                 => $request->data['notes'],
//                    'no_of_travellers'      => $request->data['no_of_travellers'],
                    'country'               => $request->data['country'],
//                    'time'                  => $request->data['time'],
                    'booking_status'        => 1,
                    'payment_status'        => 1,
                    'customer_phone'        => $request->data['customer_phone'],
                    'txn_id'                => $statement->balance_transaction,
                    'payment_method'        => $request->data['payment_method'],
                    'customer_id'           => $request->data['customer_id'],

                ];

                $booking=Booking::create($data);

                foreach ($request->data['item'] as $item){
                    $booking_item=[
                        'quantity'=>$item['quantity'],
                        'price'=>$item['price'],
                        'no_of_travellers'=>$item['no_of_travellers'],
                        'country'=>$item['country'],
                        'time'=>$item['time'],
                        'date'=>$item['date'],
                        'activity_type'=>$item['activity_type'],
                        'activity_id'=>$item['activity_id'],
                        'booking_id'=>$booking->id,
                    ];
                    BookingItem::create($booking_item);

                }
                $booking_details['booking']=$booking;
                $booking_details['booking_item']=$booking_item;
                Mail::to($request->data['customer_email'])->send(new BookingEmail($booking_details));
                Mail::to('mafaz.manzoor@agiletourism.com')->send(new BookingEmail($booking_details));

                DB::commit();
                return "Booking Successfully";
            }else{
                echo 'Stripe Error: ' . $statement->error->message;
            }
        }else{
            return "paypal";

            //paypal


        }
    }



}
