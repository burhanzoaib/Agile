<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyMail extends Mailable
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

          if($this->sub == 'Order Converted! Vt-'.$orderw->id.'' || $this->sub == 'Order Converted! Or-'.$orderw->id.''|| $this->sub == 'New ReOrder of Digitizing' || $this->sub == 'New ReOrder of vector' || $this->sub == 'Your request for edit order has been placed' || $this->sub == "You Have New Order!"){
               return $this->view('emails.invoice',compact('orderw','sub'))->subject($this->sub);
          }elseif($this->sub == 'Resend Order! Or-'.$orderw->id.''  || $this->sub == 'Resend Order! Vt-'.$orderw->id.''){
			   $this->view('emails.resend',compact('orderw','sub'))->subject($this->sub);
			    foreach ($this->file['file_attached'] as $file){
                    $this->attach($file);
                }
				return $this;
		  }




//		if($this->sub == 'Order Attachment!'){
//			$this->view('emails.invoice',compact('orderw','sub'))->subject($this->sub);
//			$order_oo = json_decode($orderw->id);
//				foreach ($this->file['file_attached'] as $key => $file){
//					$old_name = pathinfo( $file, PATHINFO_BASENAME);
//					$old_name_arr =  explode('-',$old_name);
//					$new_name =  str_replace($old_name_arr[0].'-'.$old_name_arr[1].'-',$order_oo, $old_name);
//					$this->attach($file, ['as' => $new_name]);
//                    $this->attach($file);
//				}
//			return $this;
//		}




    }
}
