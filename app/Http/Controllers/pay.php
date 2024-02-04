<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Main_invoice;
use App\Models\Digitizing;
use App\Models\Vector;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;
use App\Mail\secondMail;
use Session;
use Stripe;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Validator;
use URL;
use Redirect;
use Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;



class PaymentController extends Controller
{
    // public function stripe()
    // {
    //     return view('stripe');
    // }
    
    private $_api_context;
    
    public function __construct()
    {
        $this->paypal=Setting::first();
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($this->paypal->paypal_client_id, $this->paypal->paypal_secret));
        // $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    public function stripePost(Request $request)
    {
        if(\Auth::user()->can('payment stripe')){
			DB::beginTransaction();
            $stripe_secrate=Setting::first();
            Stripe\Stripe::setApiKey($stripe_secrate->stripe_secrate);
            $invoice = Main_invoice::where('id',$request->invoiceid)->first();
            $statement=Stripe\Charge::create ([
                    "amount" => 100 * $request->amount,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => "For ".$invoice->order_type." Order" ,
            ]);
            if($statement->captured == 'true'){


            

                $invoice->is_payment=1;
                $invoice->pay_method="stripe";
                $invoice->balance_transaction = $statement->balance_transaction;
                $invoice->save();
                /////
					
					
				
                // $order = json_decode($invoice->order_no, true);     
                                            
                // foreach($order as $ore){
                    // $type = explode("-",$ore);
                    // if($type[0] == "Or"){
                        // $orderd =Digitizing::where('id',$type[1])->first();
                        // $orderd->status = 2;
                        // $orderd->is_payment = 1;
                        // $orderd->save();
                        // foreach(json_decode($orderd->mainfilezip) as $files){
                            // $attachement[] = public_path('public/images/').$files;
                        // }
                    // }else{
                        // $orderv =Vector::where('id',$type[1])->first();
                        // $orderv->status = 2;
                        // $orderv->is_payment = 1;
                        // $orderv->save();
                        // foreach(json_decode($orderv->mainfilezip) as $files){
                            // $attachement[] = public_path('public/images/').$files;
                        // }
                    // }
                    
                // }
                // $user_email=User::where('id',$invoice->user_id)->first();
                // $inv['order_data'] = Main_invoice::findOrFail($invoice->id);
                // $subject='Payment Successfully!';

                // $inv['file_attached']= $attachement;
				DB::commit();
                Mail::to($user_email->email)->send(new MyMail($inv,$subject));
                Mail::to($this->paypal->admin_email)->send(new MyMail($inv,$subject));
				
				$this->invoice_mail($invoice->order_no);
				
                Session::flash('success', 'Payment successful!');
            }else{

                Session::flash('error', 'Payment Not Successful!');
            }
            return back();
        }else{
            abort('405');
        }

    }

    public function stripePost2(Request $request)
    {
        if(\Auth::user()->can('payment stripeforMultiple')){
			DB::beginTransaction();
            $stripe_secrate=Setting::first();
            Stripe\Stripe::setApiKey($stripe_secrate->stripe_secrate);
            $invi_id=explode(',',$request->invoiceid);
            $statement=Stripe\Charge::create ([
                    "amount" => 100 * $request->amount,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => "sew and grew" ,
            ]);
        // dd($statement);
        
            if($statement->captured == 'true'){

                foreach($invi_id as $id){
                    $invoice = Main_invoice::where('id',$id)->first();
                    $invoice->is_payment=1;
                    $invoice->pay_method="stripe";
                    $invoice->balance_transaction = $statement->balance_transaction;
                    $invoice->save();

                    $order = json_decode($invoice->order_no, true);  
                    foreach($order as $ore){
                        $type = explode("-",$ore);
                        if($type[0] == "Or"){
                            $orderd = Digitizing::where('id',$type[1])->first();
                            $orderd->status = 2;
                            $orderd->is_payment = 1;
                            $orderd->save();
                            foreach(json_decode($orderd->mainfilezip) as $files){
                                $attachement[] = public_path('public/images/').$files;
                            }
                        }else{
                            $orderv = Vector::where('id',$type[1])->first();
                            $orderv->status = 2;
                            $orderv->is_payment = 1;
                            $orderv->save();
                            foreach(json_decode($orderv->mainfilezip) as $files){
                                $attachement[] = public_path('public/images/').$files;
                            }
                        }
                        
                    } 
                    $user_email=User::where('id',$invoice->user_id)->first();
                    $inwwv[] = Main_invoice::findOrFail($invoice->id);

                }
            
                $inv['order_data'] =$inwwv;

                $subject='Multi Invoice Payment Successfully!';
                $inv['file_attached']= $attachement;
				DB::commit();
                Mail::to($user_email->email)->send(new secondMail($inv,$subject));
                Mail::to($this->paypal->admin_email)->send(new secondMail($inv,$subject));
                Session::flash('success', 'Payment successful!');
            }else{

                Session::flash('error', 'Payment Not Successful!');
            }
                //yahan bhii kam hoga


            return Redirect::route('invoice.main_invoice');
        }else{
            abort('405');
        }
    }


    public function payWithPaypal()
    {
        return view('invoice.paywithpaypal');
    }

    public function postPaymentWithpaypal(Request $request)
    {
        if(\Auth::user()->can('payment paypal')){
			DB::beginTransaction();
            \Session::put('invoiceid',$request->invoiceid);
            $invoicedata = Main_invoice::where('id',$request->invoiceid)->first();
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item_1 = new Item();

            $item_1->setName($invoicedata->order_type)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($request->get('amount'));

            $item_list = new ItemList();
            $item_list->setItems(array($item_1));

            $amount = new Amount();
            $amount->setCurrency('USD')
                ->setTotal($request->get('amount'));

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Enter Your transaction description');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::route('paypal.status'))
                ->setCancelUrl(URL::route('paypal.status'));

            $payment = new Payment();
            $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));            
            try {
                //dd($this->_api_context);
                $payment->create($this->_api_context);
            } catch (\PayPal\Exception\PPConnectionException $ex) {
                if (\Config::get('app.debug')) {
                    \Session::put('error','Connection timeout');
                    return Redirect::route('invoice.show',$request->invoiceid);
                } else {
                    \Session::put('error','Some error occur, sorry for inconvenient');
                    return Redirect::route('invoice.show',$request->invoiceid);
                }
            }

            foreach($payment->getLinks() as $link) {
                if($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
            }
            
            Session::put('paypal_payment_id', $payment->getId());
			DB::commit();
            if(isset($redirect_url)) {            
                return Redirect::away($redirect_url);
            }

            \Session::put('error','Unknown error occurred');
            return Redirect::route('invoice.show',$request->invoiceid);
        }else{
            abort('405');
        }
    }

    public function postPaymentWithpaypal2(Request $request)
    {
        
        if(\Auth::user()->can('payment paypalforMultiple')){
			DB::beginTransaction();
            \Session::put('invoiceid',$request->invoiceid);
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item_1 = new Item();

            $item_1->setName('sew and grew')
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($request->get('amount'));

            $item_list = new ItemList();
            $item_list->setItems(array($item_1));

            $amount = new Amount();
            $amount->setCurrency('USD')
                ->setTotal($request->get('amount'));

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Enter Your transaction description');

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::route('paypal.status2'))
                ->setCancelUrl(URL::route('paypal.status2'));

            $payment = new Payment();
            $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));            
            try {
                //dd($this->_api_context);
                $payment->create($this->_api_context);
            } catch (\PayPal\Exception\PPConnectionException $ex) {
                if (\Config::get('app.debug')) {
                    \Session::put('error','Connection timeout');
                    return Redirect::route('invoice.show',$request->invoiceid);
                } else {
                    \Session::put('error','Some error occur, sorry for inconvenient');
                    return Redirect::route('invoice.show',$request->invoiceid);
                }
            }

            foreach($payment->getLinks() as $link) {
                if($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
            }
            DB::commit();
            Session::put('paypal_payment_id', $payment->getId());

            if(isset($redirect_url)) {            
                return Redirect::away($redirect_url);
            }

            \Session::put('error','Unknown error occurred');
            return Redirect::route('invoice.show',$request->invoiceid);
        }else{
            abort('405');
        }
    }

    public function getPaymentStatus(Request $request)
    {        
        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('paypal.paywithpaypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));        
        $result = $payment->execute($execution, $this->_api_context);
        $invoiceid = Session::get('invoiceid');
        if ($result->getState() == 'approved') {  
           
            $invoice = Main_invoice::where('id',$invoiceid)->first();
            $invoice->is_payment = 1;
            $invoice->pay_method="paypal";
            $invoice->balance_transaction = $payment_id;
            $invoice->save();
			
			////
			
			$order = json_decode($invoice->order_no, true);     
										
			foreach($order as $ore){
				$type = explode("-",$ore);
				if($type[0] == "Or"){
					$orderd =Digitizing::where('id',$type[1])->first();
					$orderd->status = 2;
					$orderd->is_payment = 1;
					$orderd->save();
					foreach(json_decode($orderd->mainfilezip) as $files){
                        
                        $attachement[] = public_path('public/images/').$files;

					}
				}else{
					$orderv =Vector::where('id',$type[1])->first();
					$orderv->status = 2;
					$orderv->is_payment = 1;
					$orderv->save();
					foreach(json_decode($orderv->mainfilezip) as $files){
                        // $old_name = pathinfo( $files, PATHINFO_BASENAME);
                        // $old_name_arr =  explode('-',$old_name);
                        // $new_name =  str_replace($old_name_arr[0].'-'.$old_name_arr[1],'Vt-'.$orderv->id,$old_name);

						// $attach = public_path('public/images/').$files;
                        // $attachement[]= rename(basename($attach), $new_name);

						 $attachement[] = public_path('public/images/').$files;
					}
				}
				
			}
			
			$inv['file_attached']= $attachement;
            $user_email=User::where('id',$invoice->user_id)->first();
            $inv['order_data'] = Main_invoice::findOrFail($invoice->id);
            $subject='Payment Successfully!';
            Mail::to($user_email->email)->send(new MyMail($inv,$subject));
            Mail::to($this->paypal->admin_email)->send(new MyMail($inv,$subject));
			
			//

            \Session::put('success','Payment success !!');
            return Redirect::route('invoice.show',$invoiceid);
        }
        \Session::put('error','Payment failed !!');
        return Redirect::route('invoice.show',$invoiceid);
    }

    public function getPaymentStatus2(Request $request)
    {        
        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('paypal.paywithpaypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));        
        $result = $payment->execute($execution, $this->_api_context);
        $invoiceid = Session::get('invoiceid');
        if ($result->getState() == 'approved') {  
           
           
            $invi_id=explode(',',$invoiceid[0]);
            
            foreach($invi_id as $invoi){
                $invoice = Main_invoice::where('id',$invoi)->first();
                $invoice->is_payment = 1;
                $invoice->pay_method="paypal";
                $invoice->balance_transaction = $payment_id;
                $invoice->save();
                $order = json_decode($invoice->order_no, true); 

                foreach($order as $ore){
                    $type = explode("-",$ore);
                    if($type[0] == "Or"){
                        $orderd =Digitizing::where('id',$type[1])->first();
                        $orderd->status = 2;
                        $orderd->is_payment = 1;
                        $orderd->save();
                        foreach(json_decode($orderd->mainfilezip) as $files){
                            
                            $attachement[] = public_path('public/images/').$files;
    
                        }
                    }else{
                        $orderv =Vector::where('id',$type[1])->first();
                        $orderv->status = 2;
                        $orderv->is_payment = 1;
                        $orderv->save();
                        foreach(json_decode($orderv->mainfilezip) as $files){
                            // $old_name = pathinfo( $files, PATHINFO_BASENAME);
                            // $old_name_arr =  explode('-',$old_name);
                            // $new_name =  str_replace($old_name_arr[0].'-'.$old_name_arr[1],'Vt-'.$orderv->id,$old_name);
    
                            // $attach = public_path('public/images/').$files;
                            // $attachement[]= rename(basename($attach), $new_name);
    
                             $attachement[] = public_path('public/images/').$files;
                        }
                    }
                    
                }
                $user_email=User::where('id',$invoice->user_id)->first();
                $invnn[] = Main_invoice::findOrFail($invoice->id);
            }

			$inv['order_data'] = $invnn;
			$inv['file_attached']= $attachement;
            
            
            $subject='Multi Invoice Payment Successfully!';
            Mail::to($user_email->email)->send(new secondMail($inv,$subject));
            Mail::to($this->paypal->admin_email)->send(new secondMail($inv,$subject));

            \Session::put('success','Payment success !!');
            return redirect()->back();
        }
        \Session::put('error','Payment failed !!');
            return redirect()->back();

    }

	public function invoice_mail($order_id){
		
		 $order = json_decode($order_id, true);     
                                            
                foreach($order as $ore){
                    $type = explode("-",$ore);
                    if($type[0] == "Or"){
                        $orderd =Digitizing::where('id',$type[1])->first();
                        $orderd->status = 2;
                        $orderd->is_payment = 1;
                        $orderd->save();
                        foreach(json_decode($orderd->mainfilezip) as $files){
                            $attachement[] = public_path('public/images/').$files;
                        }
						
						$user_email=User::where('id',$orderd->user_id)->first();
					   // $inv['order_data'] = Main_invoice::findOrFail($invoice->id);
						$digitizing['order_data'] = $orderd;
						$subject='Order Attachment!';
						$inv['file_attached']= $attachement;
						Mail::to($user_email->email)->send(new MyMail($inv,$subject));	
				
						
                    }else{
                        $orderv =Vector::where('id',$type[1])->first();
                        $orderv->status = 2;
                        $orderv->is_payment = 1;
                        $orderv->save();
                        foreach(json_decode($orderv->mainfilezip) as $files){
                            $attachement[] = public_path('public/images/').$files;
                        }
						
						$user_email=User::where('id',$orderv->user_id)->first();
					   // $inv['order_data'] = Main_invoice::findOrFail($invoice->id);
						$digitizing['order_data'] = $orderv;
						$subject='Order Attachment!';
						$inv['file_attached']= $attachement;
						Mail::to($user_email->email)->send(new MyMail($inv,$subject));	
                    }
                    
                }
                
		
	}


}
