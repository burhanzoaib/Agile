<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class secondMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($file,$subb)
    {

        $this->file=$file;
        $this->sub=$subb;
    } 

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $orderw   = $this->file['order_data'];
        $sub      = $this->sub;
        if(isset($this->file['userData'])){
             $userData = $this->file['userData'];
             $password = $this->file['password'];
        }
        if(isset($this->file['file_attached'])){
             $file_attached = $this->file['file_attached'];
        }

        if($this->sub == "Multi Invoice Payment Successfully!"){
               
            return $this->view('emails.payment_multi',compact('orderw','sub'))->subject($this->sub);
            // foreach($orderw as $ore){
                // $order_oo = json_decode($ore->order_no);
                
                // foreach ($this->file['file_attached'] as $key => $file){
					
					
                    // $old_name = pathinfo( $file, PATHINFO_BASENAME);
                    // $old_name_arr =  explode('-',$old_name);
                    // $new_name =  str_replace($old_name_arr[0].'-'.$old_name_arr[1].'-',$order_oo[0], $old_name);
                    // $this->attach($file, ['as' => $new_name]);                         //vt-9

                    // $this->attach($file);
                // }

            // }
            // return $this;

       }
	   
	    if($this->sub == "Order Attachment!"){
               
            $this->view('emails.invoice',compact('orderw','sub'))->subject($this->sub);
            foreach($orderw as $ore){
                $order_oo = json_decode($ore->order_no);
                
                foreach ($this->file['file_attached'] as $key => $file){
					
					
                    $old_name = pathinfo( $file, PATHINFO_BASENAME);
                    $old_name_arr =  explode('-',$old_name);
                    $new_name =  str_replace($old_name_arr[0].'-'.$old_name_arr[1].'-',$order_oo[0], $old_name);
                    $this->attach($file, ['as' => $new_name]);                         //vt-9

                    $this->attach($file);
                }

            }
            return $this;

       }
	   
	   
       
   

    }
}
