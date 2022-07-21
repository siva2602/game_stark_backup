<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use Auth;
use DB;
use Mail,GeoIP;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Facades\Storage;
use File;

class UserController extends Controller
{

  function index(Request $request)
  {
    $json= json_decode(base64_decode(base64_decode(request()->data)),true);       
    geoip()->getLocation(null);
    $ip=\Request::ip();
    $arr_ip= geoip()->getLocation($ip);
    
    
    if($json['Utype']=="gl"){
     $user= Users::where('person_id', $json['Uperson'])->first();  
    }else{
      $user= Users::where('email',$json['data'])->first();
    }
 
    if($user){
        if (!$user || !Hash::check($json['Upassword'],$user->password)) {
            
          if ($json['Upassword']!=$user->password) {
            return response([
                'YldWemMyRm5aUT09' =>'Incorrent Password.','Y21WemNHOXVjMlU9'=> 404]);
            }  
        }
        
        $security=DB::table('app_setting')->where('id',1)->get();
        
        
         if($json['vp']=="true"){
            if($security[0]->vpn_monitor=="true"){ UserController::logmonitor($user->cust_id,"vpn"); }
            if($security[0]->auto_banvpn_user=="true"){ 
                UserController::banuser($user->cust_id,"Account Banned for Security Reason Used Vpn");
                 return response([
                'YldWemMyRm5aUT09' =>"Account Banned for Security Reason  Used Adblock",'Y21WemNHOXVjMlU9'=> 404]);   
            }
            if($security[0]->block_vpn=="true"){
             return response([
                'YldWemMyRm5aUT09' =>"Vpn Detected Please Disabled Vpn to Use App",'Y21WemNHOXVjMlU9'=> 404]);     
            }
        }
        
        if($user->country==null && $user->ip==null){
            $u = Users::find($user->cust_id);
            $u->ip=$ip;
            $u->country=$arr_ip->iso_code;
            $u->save();
        }
        
        if($user->country!=null){
            if($user->country != $arr_ip->iso_code && $security[0]->auto_bancountry_change=="true"){
             UserController::banuser($user->cust_id,"Account Banned for Security Reason Country Changed");
             return response([
                'YldWemMyRm5aUT09' =>"Account Banned for Security Reason Country Changed".$user->country,'Y21WemNHOXVjMlU9'=> 404]);      
            }
        }
        
        if($security[0]->block_root_device=="true" && $json['root']=="true"){
           return response([
                'YldWemMyRm5aUT09' =>"Security Reason You Cant Use App on Rooted Device",'Y21WemNHOXVjMlU9'=> 404]);      
        }
        
  
        if($json['adblock']=="true"){
            if($security[0]->monitor_adblock=="true"){ UserController::logmonitor($user->cust_id,"adblock"); }
            if($security[0]->auto_banadblock=="true"){
                 UserController::banuser($user->cust_id,"Account Banned for Security Reason Used Adblock");
             return response([
                'YldWemMyRm5aUT09' =>"Account Banned for Security Reason  Used Adblock",'Y21WemNHOXVjMlU9'=> 404]);     
            }
        }


        if($user->status==1){
            return response([
                'YldWemMyRm5aUT09' =>$user->reason,'Y21WemNHOXVjMlU9'=> 404]);      
        }

        $user->tokens()->delete();
        $token = $user->createToken('my-app-token')->plainTextToken;
        $newtoken= base64_encode($token.$user->token);
        $newuser= base64_encode($user);
        $response = [
            'ZFhObGNnPT0=' => base64_encode($newuser),
            'WkdWMmFXTmxYMmxr' => base64_encode($newtoken),
            'Y21WemNHOXVjMlU9'=> 201,
            'YldWemMyRm5aUT09' =>'VEc5bmFXNGdVM1ZqWTJWemN3PT0='
        ];
    
         return response($response);
          
    }else{
        return response([
                'YldWemMyRm5aUT09' =>'Email Not Found.','Y21WemNHOXVjMlU9'=> 404]);  
    }           
     
    }
    
  public function gloin(Request $request){
      $json= json_decode(base64_decode(base64_decode(request()->data)),true);
          geoip()->getLocation(null);
          $ip=\Request::ip();
          $arr_ip= geoip()->getLocation($ip);
          $security=DB::table('app_setting')->where('id',1)->get();
           $id= UserController::genUserCode();
             $user = Users::where('person_id',$json['uperson'])->first(); 
              if($user){
                 if(!empty($user->tokens())){
                     $user->tokens()->delete();
                 }
                 
                    $token = $user->createToken('my-app-token')->plainTextToken;
                    $newtoken= base64_encode($token.$user->token);
                    $newuser= base64_encode($user);
                    $response = [
                        'ZFhObGNnPT0=' => base64_encode($newuser),
                        'WkdWMmFXTmxYMmxr' => base64_encode($newtoken),
                        'Y21WemNHOXVjMlU9'=> 201,
                        'YldWemMyRm5aUT09' =>'VEc5bmFXNGdVM1ZqWTJWemN3PT0='
                    ];
                     return response($response);
             }
             else{
                 
                $userdev = DB::table('customer')->where(['token'=>$json['utoken']])->count();
                if($security[0]->onedevice=="true"){
                      if($userdev>0){
                              return response(['YldWemMyRm5aUT09' => ' Account Already Exist!','Y21WemNHOXVjMlU9' => 404]);   
                      }  
                   }else if($security[0]->oneip_device=="true"){
                      $userraw = DB::table('customer')->where(['ip'=>$ip])->count();
                    if($userraw>0){
                         return response(['YldWemMyRm5aUT09' => ' Account Already Exist!','Y21WemNHOXVjMlU9' => 404]);   
                    } 
                  }   
                
                $user = new Users;
                $user->name=    $json['uusername'];
                $user->email    = $json['uemail'];
                $user->person_id    = $json['uperson'];
                $user->token    = $json['utoken'];
                $user->profile    = $json['uprofile'];
                $user->p_token    = $json['up_token'];
                $user->type    = "google";
                $user->refferal_id = $id;
                $user->ip    = $ip;
                $user->country    = $arr_ip->iso_code;
                $user->balance  = 0;
                $res_user=$user->save();
                $userid=$user->cust_id;
               
               $getuser = Users::where('cust_id',$userid)->first();
               if(!empty($user->tokens())){
                     $user->tokens()->delete();
                 }
                 
                $token = $user->createToken('my-app-token')->plainTextToken;
                $newtoken= base64_encode($token.$user->token);
                $newuser= base64_encode($getuser);
                $response = [
                    'ZFhObGNnPT0=' => base64_encode($newuser),
                    'WkdWMmFXTmxYMmxr' => base64_encode($newtoken),
                    'Y21WemNHOXVjMlU9'=> 201,
                    'YldWemMyRm5aUT09' =>'VEc5bmFXNGdVM1ZqWTJWemN3PT0='
                ];
                 return response($response);
           }
    
    }
  

  public function list(Request $request)
  {
        return response([
                'users' => Users::all(),
                'success' => 1
            ]);
  }

  public function decrypt($data){
        $data= base64_decode($data);
        return $data;
    }

  public function genUserCode(){
     $this->refferal_id = [
        'refferal_id' => mt_rand(123456,999999)
    ];

    $rules = ['refferal_id' => 'unique:customer'];

    $validate = Validator::make($this->refferal_id, $rules)->passes();

    return $validate ? $this->refferal_id['refferal_id'] : $this->genUserCode();
    }

  public function store(Request $request)
  {
      $json= json_decode(base64_decode(base64_decode(request()->data)),true);
      geoip()->getLocation($ip = null);
      $ip=\Request::ip();
      $arr_ip= geoip()->getLocation($ip);
      $security=DB::table('app_setting')->where('id',1)->get();

       if($json['type']==2){
            if(Users::where('name',$json['uname'])->count()>0){
                 return response([
                        'data' => 'Username has already taken','status'=> 404]);
            }
            else if(Users::where('email',$json['uemail'])->count()>0){
                 return response([
                        'data' => 'Email has already taken','status'=> 404]);
            }
            else{
              $userraw = DB::table('customer')->where(['ip'=>$ip])->count(); 
               if($security[0]->onedevice=="true"){
                    $div = DB::table('customer')->where(['token'=>$json['utoken']])->count();
                  if($div>0){
                          return response(['data' => ' Account Already Exist!','status' => 404]);   
                  } 
               }
               
               if($userraw>$security[0]->oneip_device){
                     return response(['data' => ' Account Already Exist!','status' => 404]);   
                }else{
                        return response(['data' => '','status'=> 201]); 
               } 
           }

       }
       else if($json['type'] == 5){
               
          if(Users::where('name',$json['uname'])->count()>0){
                 return response([
                        'data' => 'Username has already taken','status'=> 404]);
            }
            else if(Users::where('email',$json['uemail'])->count()>0){
                 return response([
                        'data' => 'Email has already taken','status'=> 404]);
            }
            else{
              $userraw = DB::table('customer')->where(['ip'=>$ip])->count(); 
               if($security[0]->onedevice=="true"){
                    $div = DB::table('customer')->where(['token'=>$json['utoken']])->count();
                  if($div>0){
                          return response(['data' => ' Account Already Exist!','status' => 404]);   
                  } 
               }
               if($userraw>$security[0]->oneip_device){
                     return response(['data' => ' Account Already Exist!','status' => 404]);   
               }
           }     
               
               
          $id= UserController::genUserCode();
          $info=DB::table('app_setting')->where('id',1)->get();
          $bonus = $info[0]->bonus;  
          $referbonus = $info[0]->referral_points;  
              
            $image = $request->newimage;
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
            $filename = preg_replace("/\s+/", '-', $filename);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore = uniqid().'_'.time().'.'.$extension;
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(150,150);
            $save= $image_resize->save('images/user/'.$fileNameToStore);

                $user = new Users;
                $user->name=    $json['uname'];
                $user->email    = $json['uemail'];
                $user->token    = $json['utoken'];
                $user->profile    = $fileNameToStore;
                $user->p_token    = $json['up_token'];
                $user->refferal_id = $id;
                $user->ip    = $ip;
                $user->country    = $arr_ip->iso_code;
                $user->balance  = 0;
                $user->password = Hash::make($json['upassword']);
                $res_user=$user->save();
                $userid=$user->cust_id;

                if($res_user){
                     return response(['data' => 'Account Created Login Now !','status' => 201]);   
                }else{
                     return response(['data' => 'Error while create account!','status' => 404]);   
                }     
           }
      
    }

  public function delete($id, Request $request)
  {
        $user = User::find($id);
        if($user){
            $user->delete();
            return response(['message' => 'User has been deleted','status' => 1]);
        }
        else
            return response(['message' => 'Sorry! Not found!','status' => 0]);
    }
    
  function banuser($userid,$reason){
      $user= Users::find($userid);
      $user->status=1;
      $user->balance=0;
      $user->reason=$reason;
      $user->banned_time=Carbon::now(); 
      $user->save();
    }
    
  function logmonitor($userid,$type){
       DB::table('monitor_report')->insert(['userid'=>$userid,'type'=>$type]);
    }

  public function fetch_coin(){
      $json= json_decode(base64_decode(base64_decode(request()->data)),true);
       $id=$json['mid'];
       $data =Users::find($id);
       return response(['data' =>$data->balance,'status'=>1]);
    }
    
  public function collect_bonus(Request $req){
         $userid=$req->uid;
         $getuser  = Users::find($userid);
         $fetchcoin = Users::where('refferal_id',$req->from_refer)->get(); 
    
         $setting= DB::table('app_setting')->where('id',1)->get(); 
         $bonus = $setting[0]->bonus;  
         $referbonus = $setting[0]->referral_points; 
         
         $total=$getuser->balance+$bonus;
         
         if($getuser->refferal_id ==$req->from_refer){
            return response(['data' =>"You cant Use your refer code",'status' => 404]);      
         }
         
         if(!empty($getuser->from_refferal_id)){
              return response(['data' =>"Welcome Bonus Already Claimed",'status' => 404]);      
         }
         
         if($fetchcoin){
             $trns = DB::table('transaction')
                     ->insert(['tran_type'=>'credit',
                    'user_id'=>$userid,
                    'amount'=>$bonus,
                    'type'=>'welcome bonus',
                    'remained_balance'=>$total,
                    'remarks'=>'Welcome Bonus' ]);

            $user  = Users::where('cust_id','=',$userid)->update(['balance'=>$total,'refer'=>'true','from_refferal_id'=>$req->from_refer]);
            $fetchcoin = Users::where('refferal_id',$req->from_refer)->get(); 
    	    $update=Users::find($fetchcoin[0]->cust_id);
            $update->balance=$fetchcoin[0]->balance + $referbonus;
            $res= $update->save();    
            
            $trnss = DB::table('transaction')
                 ->insert(['tran_type'=>'credit',
                'user_id'=>$fetchcoin[0]->cust_id,
                'amount'=>$referbonus,
                'type'=>'Invite',
                'remained_balance'=>$fetchcoin[0]->balance + $referbonus,
                'remarks'=>'Referral Bonus Credit From '.$getuser->name ]);

            return response(['data' => $bonus." Coin Claimed Successfully",'status' => 201]); 
         }else{
           return response(['data' =>"Invalid Refer Code",'status' => 404]);      
         }
         
    }
    
    
  public function reset(Request $request){
       $appname=config('app.name');

       $valideator = Validator::make($request->all(), [
            'email'    => 'email|exists:customer'
        ],[
           'email.email' => 'Enter Valid Email !',
           'email.exists' => 'Email Not Found !'
        ]);
        
         if($valideator->fails()){
             return response([
                    'data' => $valideator->errors()->first(),'status'=> 404]);
        }
        
        $token = Str::random(60);
        $otp= UserController::genUserCode();
    
         $details = [
            'title' => $appname,
            'body' => 'Your Password Reset Otp is  '.$otp
        ];
           
            \Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));
            
             DB::table('password_reset')->insert(
            ['email' => $request->email, 'token' => $token, 'otp'=>$otp]
            );
            return response(['status'=>201,'data'=>'Otp Sended To Your Mail']);
        }
        
    public function leaderboard(){
       $data = DB::table('customer')
      ->select('customer.name','customer.balance','customer.profile','customer.type')
      ->orderBy('customer.balance','DESC')
      ->take('30')
      ->get();
      
      if($data){
                return response(['data'=>$data,'status'=>1]);  
            }else{
                return response(['data'=>'Data Not Found', 'status'=>0]);
            }
    }    
        
    public function verify(Request $req){
        $otp=$req->otp;
        $dataotp = DB::table('password_reset')->where('email',$req->email)->orderBy('id', 'DESC')->limit(1)->get()->first()->otp;
        
        if($otp==$dataotp){
            return response(['status'=>201,'data'=>$dataotp,'data'=>'Otp verified']); 
        }else{
          return response(['status'=>400,'data'=>'Wrong OTP']);   
        }
    }
    
    public function update_password(Request $req){
       $data =Users::where('email',$req->email)->get();
       $userid=$data[0]->cust_id;
       
       $update=Users::find($userid);
        $update->password=Hash::make($req->password);
        $update->save();
        if($update){
            return response(['data'=>'Password Updated Successfully Login Now','status'=>201]);
        }else{
            return response(['data'=>'Error to Update Password','status'=>400]);
        }
    }
    
    public function updatetoken(Request $req){
        $update=Users::find($req->id);
        $update->p_token=$req->p_token;
        $update->save();
        if($update){
            return response(['data'=>'updated','status'=>201]);
        }else{
            return response(['data'=>'Error to Update','status'=>400]);
        }
    }
    
    public function send_otp(Request $request){
       $appname=config('app.name');

       $valideator = Validator::make($request->all(), [
            'email'    => 'email'
        ],[
           'email.email' => 'Enter Valid Email !'
        ]);
        
         if($valideator->fails()){
             return response([
                    'data' => $valideator->errors()->first(),'status'=> 404]);
        }
        
        $token = Str::random(60);
        $otp= UserController::genUserCode();
    
         $details = [
            'title' => $appname,
            'body' => ''.$otp
        ];
           
            \Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));
            
             DB::table('password_reset')->insert(
            ['email' => $request->email, 'token' => $token, 'otp'=>$otp]
            );
            return response(['status'=>201,'data'=>'Otp Sended To Your Mail']);
        }
    
}
