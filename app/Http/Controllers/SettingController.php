<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DB::table('setting')->get();
        return view('pages.setting-general',['setting'=>$data]);
    }
    
    public function security()
    {
        $data=DB::table('app_setting')->get();
        return view('pages.setting-security',['setting'=>$data]);
    }
    
    public function promotion()
    {
        $data=DB::table('app_setting')->get();
        return view('pages.setting-promotion',['data'=>$data]);
    }

    public function adsView()
    {
        $data=DB::table('setting')->get();
        return view('pages.setting-ads',['setting'=>$data]);
    }
    
    public function maintenance()
    {
        $data=DB::table('setting')->get();
        return view('pages.update',['setting'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->type=="general"){
           if(isset($request->icon)){
                $image = $request->icon;
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
                $filename = preg_replace("/\s+/", '-', $filename);
                $extension = $image->getClientOriginalExtension();
                 $fileNameToStore = 'favicon.png';
                 $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(80,80);
                $save= $image_resize->save('images/'.$fileNameToStore);
                $icon=$fileNameToStore;
            }else{
               $fileNameToStore= $request->icon;
            }
            $data=['app_name'=>$request->app_name,
            'app_version'=> $request->version,
            'app_author'=> $request->author,
            'app_contact'=> $request->contact,
            'app_website'=> $request->website,
            'app_description'=> $request->detail,
            'refer_text'=> $request->refer_text,
            'refer_msg'=> $request->refer_msg,
            'app_email'=> $request->email,
            'youtube'=> $request->youtube,
            'privacy_policy'=> $request->privacy_policy,
            'app_icon'=>$fileNameToStore,
            'telegram'=> $request->telegram,
            'fb'=> $request->fb];
    
            $setting = DB::table('setting')->where('id',1)->update($data);
    
                    if($setting){
                        return redirect('/setting-general')->with('success', 'Task Created Successfully!');
                    }else{
                        return redirect('/setting-general')->with('error', 'Technical Error!');
                    }  
        }
        else if($request->type=="update"){
            if($request->up_status=="on"){$up_status='true';}else{  $up_status='false'; }
            if($request->up_btn=="on"){ $up_btn='true';}else{  $up_btn='false'; }
            
           $datas=['up_status'=>$up_status,
            'up_mode'=> $request->up_mode,
            'up_version'=> $request->up_version,
            'up_msg'=> $request->up_msg,
            'up_link'=> $request->up_link,
            'up_btn'=> $up_btn];
    
            $setting = DB::table('setting')->where('id',1)->update($datas);
    
                if($setting){
                    return redirect('setting/maintenance')->with('success', 'Update Successfully!');
                }else{
                    return redirect('setting/maintenance')->with('error', 'Technical Error!');
                }   
        }
        else if($request->type=="ads"){
              if($request->statartapp_reward=="on"){$statartapp_reward='true';}else{ $statartapp_reward='false'; }
             if($request->applovin_reward=="on"){$applovin_reward='true';}else{ $applovin_reward='false'; }
             if($request->unity_reward=="on"){$unity_reward='true';}else{ $unity_reward='false'; }
             if($request->adcolony_reward=="on"){$adcolony_reward='true';}else{ $adcolony_reward='false'; }
             if($request->interstital=="on"){$interstital='true';}else{ $interstital='false'; }
            
            $data=['startappid'=>$request->startappid,
            'applovin_rewardID'=> $request->applovin_rewardID,
            'unity_gameid'=> $request->unity_gameid,
            'unity_rewardid'=> $request->unity_rewardid,
            'banner_type'=> $request->banner_type,
            'adcolony_appID'=> $request->adcolony_appID,
            'adcolony_zoneid'=> $request->adcolony_zoneid,
            'bannerid'=> $request->bannerid,
            'interstital_count'=> $request->interstital_count,
            'interstital_type'=> $request->interstital_type,
            'interstital_ID'=> $request->interstital_ID,
            'interstital'=> $interstital,
            'statartapp_reward'=> $statartapp_reward,
            'applovin_reward'=> $applovin_reward,
            'unity_reward'=> $unity_reward,
            'adcolony_reward'=> $adcolony_reward];
    
            $setting = DB::table('setting')->where('id',1)->update($data);
    
                if($setting){
                    return redirect('setting/ads')->with('success', 'Update Successfully!');
                }else{
                    return redirect('setting/ads')->with('error', 'Technical Error!');
                }   
        }
       
      }
  
    public function spin(){
        $data= DB::table('wheel_points')->get();
        return view('pages.spin',['data'=>$data]);
    }

    public function spinupdate(Request $request){
        $data=['position_1'=>$request->p_1,
        'position_2'=> $request->p_2,
        'position_3'=> $request->p_3,
        'position_4'=> $request->p_4,
        'position_5'=> $request->p_5,
        'position_6'=> $request->p_6,
        'position_7'=> $request->p_7,
        'position_8'=>  $request->p_8,
        'pc_1'=> $request->pc_1,
        'pc_2'=> $request->pc_2,
        'pc_3'=> $request->pc_3,
        'pc_4'=> $request->pc_4,
        'pc_5'=> $request->pc_5,
        'pc_6'=> $request->pc_6,
        'pc_7'=> $request->pc_7,
        'pc_8'=> $request->pc_8];

        $setting = DB::table('wheel_points')->where('id',1)->update($data);
            if($setting){
                return redirect('/setting/spin')->with('success', 'Update Successfully!');
            }else{
                return redirect('/setting/spin')->with('error', 'Technical Error!');
            } 
    }

    public function app(){
        $data= DB::table('app_setting')->get();
        $game=json_decode($data[0]->game);
        $quiz=json_decode($data[0]->quiz);
        $pay=json_decode($data[0]->pay_info);
        return view('pages.setting',[
            'data'=>$data,
            'game_minute'=>$game[0]->game_minute,
            'game_coin'=>$game[0]->game_coin,
            'game_message'=>$game[0]->game_message,
            'quiz_time'=>$quiz[0]->quiz_time,
            'quiz_skip'=>$quiz[0]->quiz_skip,
            'quiz_half'=>$quiz[0]->quiz_half,
            'paypal'=>$pay[0]->paypal,
            'razorpay'=>$pay[0]->razorpay,
            'upi'=>$pay[0]->upi,
            'paypal_key'=>$pay[0]->paypal_key,
            'razorpay_key'=>$pay[0]->razorpay_key,
            'upi_key'=>$pay[0]->upi_key,
            'store_name'=>$pay[0]->store_name,
            'payee_name'=>$pay[0]->payee_name]);
    }
 
    public function appupdate(Request $request){
        if($request->type=="app"){
          if($request->mlm=="on"){ $mlm='true'; }else{ $mlm='false'; }
          if($request->google_login=="on"){$google_login='true';}else{ $google_login='false'; }
          if($request->promote_content=="on"){$promote_content='true';}else{ $promote_content='false'; }
          if($request->email_verification=="on"){$email_verification='true';}else{ $email_verification='false'; }
          if($request->paypal=="on"){$paypal='true';}else{ $paypal='false'; }
          if($request->razorpay=="on"){$razorpay='true';}else{ $razorpay='false'; }
          if($request->upi=="on"){$upi='true';}else{ $upi='false'; }

            $game=array([
                'game_minute'=>$request->game_minute,
                'game_coin'=>$request->game_coin,
                'game_message'=>$request->game_message
                ]);
            $quiz=array([
                'quiz_time'=>$request->quiz_time,
                'quiz_half'=>$request->quiz_half,
                'quiz_skip'=>$request->quiz_skip
                ]);
                
            $pay=array([
                'paypal'=>$paypal,
                'razorpay'=>$razorpay,
                'upi'=>$upi,
                'paypal_key'=>$request->paypal_key,
                'razorpay_key'=>$request->razorpay_key,
                'upi_key'=>$request->upi_key,
                'store_name'=>$request->store_name,
                'payee_name'=>$request->payee_name
                ]);    
            
            $data=['spinlimit'=>$request->spin,
             'refer_mode'=> $request->refer_mode,       
            'game'=> json_encode($game),
            'day1'=> $request->day1,
            'day2'=> $request->day2,
            'day3'=> $request->day2,
            'day4'=> $request->day4,
            'day5'=> $request->day5,
            'day6'=> $request->day6,
            'day7'=> $request->day7,
            'task_mode'=> $request->task_mode,
            'limit_video'=> $request->limit_video,
            'limit_quiz'=> $request->limit_quiz,
            'limit_web'=> $request->limit_web,
            'limit_app'=> $request->limit_app,
            'max_redeem_day'=> $request->max_redeem_day,
            'scrath_limit'=> $request->scrath_limit,
            'google_login'=> $google_login,
            'promote_content'=> $promote_content,
            'email_verification'=> $email_verification,
            'bonus'=> $request->bonus,
            'scratch'=> $request->scratch,
            'quiz'=> json_encode($quiz),
            'max_promote'=>$request->max_promote,
            'app_promotecoin'=>$request->app_promotecoin,
            'video_promotecoin'=>$request->video_promotecoin,
            'promote_time'=>$request->promote_time,
            'promo_appcoin'=>$request->promo_appcoin,
            'promo_videocoin'=>$request->promo_videocoin,
            'promo_webcoin'=>$request->promo_webcoin,
            'paid_spin'=>$request->paid_spin,
            'pay_info'=>json_encode($pay),
            'referral_points'=> $request->refer];
    
            $setting = DB::table('app_setting')->where('id',1)->update($data);
                if($setting){
                    return redirect('/setting/app')->with('success', 'Update Successfully!');
                }else{
                    return redirect('/setting/app')->with('error', 'Technical Error!');
                } 
                
        }else if($request->type=="security"){
            
            if($request->onedevice=="on"){$onedevice='true';}else{  $onedevice='false'; }
            if($request->block_vpn=="on"){$block_vpn='true';}else{ $block_vpn='false'; }
            if($request->vpn_monitor=="on"){$vpn_monitor='true';}else{ $vpn_monitor='false'; }
            if($request->block_root_device=="on"){$block_root_device='true';}else{ $block_root_device='false'; }
            
            if($request->auto_banvpn_user=="on"){ $auto_banvpn_user='true';}else{  $auto_banvpn_user='false'; } 
            if($request->auto_banadblock=="on"){ $auto_banadblock='true';}else{  $auto_banadblock='false'; }
            if($request->monitor_adblock=="on"){ $monitor_adblock='true';}else{  $monitor_adblock='false'; }
            if($request->auto_bancountry_change=="on"){ $auto_bancountry_change='true';}else{  $auto_bancountry_change='false'; }
            if($request->auto_banroot=="on"){ $auto_banroot='true';}else{  $auto_banroot='false'; }

           $datas=['onedevice'=>$onedevice,
                'block_vpn'=>$block_vpn,
                'vpn_monitor'=>$vpn_monitor,
                'auto_banroot'=>$auto_banroot,
                'auto_banvpn_user'=>$auto_banvpn_user,
                'auto_banadblock'=>$auto_banadblock,
                'monitor_adblock'=>$monitor_adblock,
                'oneip_device'=>$request->oneip_device,
                'block_root_device'=>$block_root_device,
                'auto_bancountry_change'=>$auto_bancountry_change];
    
            $setting = DB::table('app_setting')->where('id',1)->update($datas);
    
                if($setting){
                    return redirect('setting/security')->with('success', 'Update Successfully!');
                }else{
                    return redirect('setting/security')->with('error', 'Technical Error!');
                }   
        }
        
        
    }
}
