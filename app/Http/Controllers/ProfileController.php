<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Digitizing;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Setting;
use App\Models\Country;
use App\Models\state;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;
use Redirect;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
		
		$this->paypal=Setting::first();
        $this->section = new \stdClass();
        $this->section->title = 'Profile';
        $this->section->heading = 'Profile';
        $this->section->slug = 'profile';
        $this->section->folder = 'Profile';
    }

    public function index()
    {
        $section=$this->section;
        $user = User::where('id',\Auth::user()->id)->first();
		//dd($user->toArray());
        $countries=Country::get();
		$section->method = 'post';
        return view($section->folder.'.index',compact('section','user','countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $digitizing=[];
        $section = $this->section;
        $section->method = 'put';
       // $section->route = $section->slug.'.update';
        return view($section->folder.'.form',compact('section','digitizing'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $section=$this->section;
    //     if($request->has('pic')){
    //         $qwe = $request->pic->getClientOriginalName();
    //         $request->pic->move(public_path('public/profileimages'), $qwe);
    //         $request->request->add(['image'=>$qwe]);
			
	// 		$digitizing = User::create($request->all());

    //     }
    //     $request->request->add(['user_id'=>\Auth::user()->id,'status'=>1]);
    //     $digitizing = Digitizing::create($request->all());

    //     $subject='New Order of Digitizing';
    //     Mail::to($this->paypal->admin_email)->send(new MyMail($digitizing,$subject));
    //     $subject='Thanks For Ordering!';
    //     Mail::to(\Auth::user()->email)->send(new MyMail($digitizing,$subject));

    //     $request->session()->flash('flash_message', 'Record has been added successfully.');
    //     return redirect()->route($section->slug.'.index');
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function state(Request $request)
    {
        $state=State::where('country_id',$request->country_id)->get();
        $html="";
        foreach($state as $stat){
            $html.='<option value='.$stat->state_name.'>'.$stat->state_name.'</option>';
        }
        echo $html;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profilepasswoerd(Request $request,$id)
    {
		$section=$this->section;
		if($request->password == $request->confirm){
			$data=[
				'password'=>Hash::make($request->password)
			];
			User::where('id',$id)->update($data);
			 echo '<script type ="text/JavaScript">';  
			echo 'alert("Password Change")';  
			echo '</script>';  
			return redirect()->route($section->slug.'.index');
		}else{
			 echo '<script type ="text/JavaScript">';  
			echo 'alert("Confirm password not Same")';  
			echo '</script>';  
			return redirect()->route($section->slug.'.index');
		}
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profileupdate(Request $request, $id)
    {
		//dd($request->all());
        $section = $this->section;
        $file = User::find($id);
        if($request->hasFile('pic')){
						//dd($request->all());

            $qwe = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('public/profileimages'), $qwe);
			$data=[
				'name'=>$request->name,
				'lname'=>$request->lname,
				'image'=>$qwe,
				'phone'=>$request->phone,
				'country'=>$request->country,
				'state'=>$request->state,
				'postal'=>$request->postal,
				'address'=>$request->address,
				'gender'=>$request->gender,
				'find'=>$request->find,
			];
			User::where('id',$id)->update($data);
        }else{
            $data=[
				'name'=>$request->name,
				'lname'=>$request->lname,
				'phone'=>$request->phone,
				'country'=>$request->country,
				'state'=>$request->state,
				'postal'=>$request->postal,
				'address'=>$request->address,
				'gender'=>$request->gender,
				'find'=>$request->find,
			];
			User::where('id',$id)->update($data);
        }
        return redirect()->route($section->slug.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
		Digitizing::where('id',$id)->delete();
		return redirect()->back(); 

    }
	
	
	
	
	public function settings(){
		
		$section=$this->section;
		//if(\Auth::user()->can('setting openSetting')){
			$setting=Setting::first();
			$section->method = 'post';
			return view($section->folder.'.setting',compact('section','setting'));
		// }else{
        //     abort('405');
        // }

	}
	
	
	public function setting_update($id,Request $request){
		//if(\Auth::user()->can('setting settingUpdate')){
            $data=[
                
                'stripe_key'=>$request->stripe_key,
                'stripe_secrate'=>$request->stripe_secrate,
                'admin_email'=>$request->admin_email,
                'admin_phone'=>$request->admin_phone,
                'vat_tax'=>$request->vat_tax,
                'paypal_client_id'=>$request->paypal_client_id,
                'paypal_secret'=>$request->paypal_secret,
                'pay_sendbox'=>$request->pay_sendbox,
                'address'=>$request->address,
                'content'=>$request->content,
            
            ];
            
            Setting::where('id',$id)->update($data);
            
            return Redirect::back()->withErrors(['msg' => 'Updated Successfully!']);
        //}else{
          //  abort('405');
        //}

	}

   
   


   

       


}
