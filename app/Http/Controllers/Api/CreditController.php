<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use DB;
use GeoIP;
use App\Models\Users;
use Carbon\Carbon;

class CreditController extends Controller
{
    
        
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dailycheckin()
    {
        $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $id=$json['mid'];
       $day =Carbon::parse(Carbon::now())->format('l');
         if($day=="Monday"){
             $coin = DB::table('app_setting')->where('id',1)->get()->first()->day1;
         }else if($day=="Tuesday"){
            $coin = DB::table('app_setting')->where('id',1)->get()->first()->day2;
         }else if($day=="Wednesday"){
              $coin = DB::table('app_setting')->where('id',1)->get()->first()->day3;
         }else if($day=="Thursday"){
            $coin = DB::table('app_setting')->where('id',1)->get()->first()->day4;
         }else if($day=="Friday"){
            $coin = DB::table('app_setting')->where('id',1)->get()->first()->day5;
         }else if($day=="Saturday"){
           $coin = DB::table('app_setting')->where('id',1)->get()->first()->day6;
         }else if($day=="Sunday"){
            $coin = DB::table('app_setting')->where('id',1)->get()->first()->day7;
         }
        
        if($coin){
            $ip=\Request::ip();
        $now = Carbon::now();
        $count = DB::table('transaction')
        ->where('user_id','=',$id)
        ->where('type','=','Daily Checkin')
        ->whereDate('inserted_at',$now)
        ->count();
            if($count>0){
                return response(['data'=>'Daily Checkin Coins Already Claimed','status'=>0]);
            }else{
                 $update= Users::find($id);   
                 $currentcoin= $update->balance;   
                 $total= $currentcoin+$coin;
                    $trns = DB::table('transaction')
                    ->insert(['tran_type'=>'credit',
                              'user_id'=>$id,
                              'amount'=>$coin,
                              'ip'=>$ip,
                              'type'=>'Daily Checkin',
                              'remained_balance'=>$total,
                              'inserted_at'=>$now,
                              'remarks'=>'Daily checkin coin claimed' ]);
                        $update->balance=$total;
                        $res=$update->save();
                        if($res){
                            return response(['data'=>$coin.' Coin Bonus Claimed','balance'=>$total,'status'=>1]);
                        }else{
                            return response(['data'=>'Error to credit','status'=>0]);
                        }
            }      
            
        }else{
           return response(['data'=>'Technical error','status'=>0]);  
        }
    }


    public function reward_request(Request $request)
    {
        $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $userid=$json['mid'];
        $limit = DB::table('app_setting')->where('id',1)->get()->first()->max_redeem_day;
        $count = DB::table('recharge_request')
        ->where('user_id','=',$userid)
        ->wheredate('date',date('Y-m-d'))
        ->count();
        if($count>=$limit){
            return response(['data'=>'You Can Submit One Request In One Day','status'=>0]);
        }
        
        
        $ip=\Request::ip();
        $update= Users::find($userid);   
        $currentcoin= $update->balance;
        $setting= DB::table('app_setting')->where('id',1)->get(); 

        $redeem=DB::table('redeem')->where('id','=',$json['tid'])->get();
        $requirecoin=$redeem[0]->points;
        
        if($currentcoin >= $requirecoin){
            $total= $currentcoin-$requirecoin;
            $update->balance=$total;
            $res= $update->save();
            
            $reward = DB::table('recharge_request')
            ->insert(['mobile_no'=>$json['data'],
                'amount'=>$requirecoin,
                'type'=>$redeem[0]->title,
                'status'=>'Pending',
                'user_id'=>$userid]);  
                
                if($reward){
                    $trns = DB::table('transaction')
                    ->insert([  'tran_type'=>'debit',
                                'user_id'=>$userid,
                                'amount'=>$requirecoin,
                                'ip'=>$ip,
                                'type'=>'Redeem',
                                'remained_balance'=>$total,
                                'remarks'=>'Redeem Request Submited' ]);

                        if($trns){
                         if($update->refer=='false' && $setting[0]->refer_mode=='redeem'){
                                $user  = Users::where('cust_id','=',$userid)->update(['refer'=>'true']);
                                $fetchcoins = Users::where('refferal_id',$fetchcoin->from_refferal_id)->get(); 
                        	    $update=Users::find($fetchcoins[0]->cust_id);
                                $update->balance=$fetchcoins[0]->balance + $setting[0]->referral_points;
                                $res= $update->save();    
                                
                                $trnss = DB::table('transaction')
                                     ->insert(['tran_type'=>'credit',
                                    'user_id'=>$fetchcoin[0]->cust_id,
                                    'amount'=>$referbonus,
                                    'type'=>'Invite',
                                    'remained_balance'=>$fetchcoins[0]->balance + $setting[0]->referral_points,
                                    'remarks'=>'Referral Bonus Credit From '.$fetchcoin[0]->name ]);
                                
                         }   

                            return response(['data'=>'Withdrawal Request Submit Successfully','balance'=>$total,'status'=>1]);
                        }else{
                            return response(['data'=>'technical error !!','status'=>0]);
                        }    
                }else{
                    return response(['data'=>'technical error','status'=>0]);
                }
        }else{
            return response(['data'=>'Not Enough Coin','status'=>0]);
        }
    } 

    public function offerwall($id,Request $req)
    {
        $now = Carbon::now();
        
        $offerinfo=DB::table('offerwall')->where('id',$id)->get();
        $postbinfo=DB::table('postback')->where('offerwall_id',$id)->get();
        
        if($offerinfo && $postbinfo){
            $offerwall=$postbinfo[0]->offerwall_name;
            $userid=$req->query(strtok($postbinfo[0]->p_userid, '='));
            $payout=$req->query(strtok($postbinfo[0]->p_payout, '='));
            $ip=$req->query(strtok($postbinfo[0]->p_ip, '='));
            $offerid=$req->query(strtok($postbinfo[0]->p_campaing_id, '='));
            $offername=$req->query(strtok($postbinfo[0]->p_offername, '='));
            
            if($offername==""){$offername="offer completed";}
            
            $fetchcoin= Users::find($userid);   
            $currentcoin= $fetchcoin->balance;   
            $total= $currentcoin+$payout;
            $trns = DB::table('transaction')
            ->insert(['tran_type'=>'credit',
                        'user_id'=>$userid,
                        'amount'=>$payout,
                        'ip'=>$ip,
                        'eventId'=>$offerid,
                        'type'=>$offername.' Credit',
                        'remained_balance'=>$total,
                        'offerwall_type'=>$offerwall,
                        'admin_remarks'=>$offerwall.' '.$offername.' Completed',
                        'remarks'=>$offername.' Completed' ]);
            $fetchcoin->balance=$total;
            $fetchcoin->save(); 
            
          NotificationController::offernotifyUser("a645b3b4-6ec2-11ec-924c-1689b9c88047",$payout.' Bonus Received',$payout.' Bonus Received for completing '.$offername);

           if($offerwall=="IronSource"){
               return $req->eventId.':OK';
           }else if($offerwall=="kiwiwall"){
               return 1;
           }else if($offerwall=="adgem"){
               return 201;
           }else if($offerwall=="offerToro"){
               return 201;
           }else{
               return 201;
           }
           
           
        }

 
        
    }
        
    public function credit_video()
    {
        $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $user=$json['mid'];
        $video=$json['tid'];
        $ip=\Request::ip();
        $now = Carbon::now();
        $coin = DB::table('youtube_video')->where('id',$video)->get();
        if($coin)
        {
           $count = DB::table('transaction')->where([['video_id','=',$video],['user_id','=',$user]])
                    ->whereDate('inserted_at',$now)->count();

            if($count>0){
                return response(['data'=> 'Coin Already Claimed','status'=>0]);
            }else{
                $update= Users::find($user);   
                $currentcoin= $update->balance;   
                $total= $currentcoin+$coin[0]->point;
                    $trns = DB::table('transaction')
                ->insert(['tran_type'=>'credit',
                            'user_id'=>$user,
                            'amount'=>$coin[0]->point,
                            'video_id'=>$video,
                            'ip'=>$ip,
                            'type'=>'Video',
                            'remained_balance'=>$total,
                            'remarks'=>'Video Watched' ]);
                    $update->balance=$total;
                   $res= $update->save();
                    if($res){
                         $counttask=DB::table('transaction')->where('video_id','=',$video)->count();
                                if($coin[0]->task_limit!="0" && $counttask>=$coin[0]->task_limit){
                                        DB::table('youtube_video')->where('id','=',$video)->update(['status'=>1]);
                                }
                        return response(['data'=> $coin[0]->point.' Coin Claimed','balance'=>$total,'status'=>1]);
                    }else{
                        return response(['data'=>'Error to credit','status'=>0]);
                    }
            }
        } 
    }

    public function credit_web()
    {
         $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $user=$json['mid'];
        $web=$json['tid'];
        $ip=\Request::ip();
        $now = Carbon::now();
        $coin = DB::table('weblink')->where('id',$web)->get();
        if($coin)
        {
           $count = DB::table('transaction')->where([['webId','=',$web],['user_id','=',$user]])
                    ->whereDate('inserted_at',$now)->count();

            if($count>0){
              return response(['data'=> 'Coin Already Claimed','status'=>0]);  
            }
            else
            {
               $update= Users::find($user);   
                $currentcoin= $update->balance;   
                $total= $currentcoin+$coin[0]->point;
                $trns = DB::table('transaction')
                ->insert(['tran_type'=>'credit',
                            'user_id'=>$user,
                            'amount'=>$coin[0]->point,
                            'ip'=>$ip,
                            'webId'=>$web,
                            'type'=>'Web Visit',
                            'remained_balance'=>$total,
                            'remarks'=>'Web Visit Coin Credited' ]);
                    $update->balance=$total;
                    $res= $update->save();
                    if($res){
                        $counttask=DB::table('transaction')->where('webId','=',$web)->count();
                                if($coin[0]->task_limit!="0" && $counttask>=$coin[0]->task_limit){
                                    DB::table('weblink')->where('id','=',$web)->update(['status'=>1]);
                                }
                        return response(['data'=> $coin[0]->point.' Coin Claimed','balance'=>$total,'status'=>1]);
                    }else{
                        return response(['data'=>'Error to credit','status'=>0]);
                    } 
            } 
        } 
    }

    public function credit_spin()
    {
        $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $user=$json['mid'];
        $reward=$json['tid'];
        $type=$json['data'];
        $ip=\Request::ip();
        $now = Carbon::now();
        $info = DB::table('app_setting')->where('id',1)->get();
        $spinlimit = DB::table('app_setting')->where('id',1)->get()->first()->spinlimit;
        $spin = DB::table('wheel_points')->where('id',1)->get();

        $userraw = DB::table('transaction')
        ->where('user_id','=',$user)
        ->where('spinhit',1)
        ->whereDate('inserted_at',$now)
        ->count();

        if($type=="paid"){
                $fetchcoin= Users::find($user);   
                $currentcoin= $fetchcoin->balance;   
                $total= $currentcoin+$reward;
                $trns = DB::table('transaction')
                ->insert(['tran_type'=>'credit',
                        'user_id'=>$user,
                        'amount'=>$reward,
                        'spinhit'=>2,
                        'ip'=>$ip,
                        'type'=>'Spin',
                        'remained_balance'=>$total,
                        'admin_remarks'=>'Spin Chance purchased',
                        'inserted_at'=>$now,
                        'remarks'=>'Spin Win Coin Credit' ]);
                $fetchcoin->balance=$total;
                $res=$fetchcoin->save();
                if($res){
                    if($spinlimit-$userraw>0){
                      $spinlimit= $spinlimit-$userraw; 
                    }else{ $spinlimit=0; }
                    return response(['data'=> $reward.' Coin Claimed','balance'=>$total,'limit'=>$spinlimit,'status'=>1]);
                 }else
                 {
                    return response(['data'=>'Error to credit','status'=>0]);
                }
            
        }
        else{
            if($userraw<=$spinlimit)
            {
                $fetchcoin= Users::find($user);   
                $currentcoin= $fetchcoin->balance;   
                $total= $currentcoin+$reward;
                $trns = DB::table('transaction')
                ->insert(['tran_type'=>'credit',
                        'user_id'=>$user,
                        'amount'=>$reward,
                        'spinhit'=>1,
                        'ip'=>$ip,
                        'type'=>'Spin',
                        'remained_balance'=>$total,
                        'inserted_at'=>$now,
                        'remarks'=>'Spin Win Coin Credit' ]);
                $fetchcoin->balance=$total;
                $res=$fetchcoin->save();
                if($res){
                    $tot=$userraw+1;
                    return response(['data'=> $reward.' Coin Claimed','balance'=>$total,'limit'=>$spinlimit-$tot,'status'=>1]);
                 }else{
                        return response(['data'=>'Error to credit','status'=>0]);
                    }
            }
        else{
            return response(['data'=>'Today Limit Completed !!','status'=>0]);
        }     
    }    
        
        
    }
    
    public function credit_scratch()
    {
         $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $user=$json['mid'];
        $reward=$json['tid'];
        $ip=\Request::ip();
        $now = Carbon::now();
        $spinlimit = DB::table('app_setting')->where('id',1)->get()->first()->scrath_limit;
        $userraw = DB::table('transaction')
        ->where('user_id','=',$user)
        ->where('scrath',1)
        ->whereDate('inserted_at',$now)
        ->count();

        if($userraw<=$spinlimit)
        {
            $fetchcoin= Users::find($user);   
            $currentcoin= $fetchcoin->balance;   
            $total= $currentcoin+$reward;
            $trns = DB::table('transaction')
            ->insert(['tran_type'=>'credit',
                        'user_id'=>$user,
                        'amount'=>$reward,
                        'scrath'=>1,
                        'ip'=>$ip,
                        'type'=>'Scratch Card',
                        'remained_balance'=>$total,
                        'inserted_at'=>$now,
                        'remarks'=>'Scratch Win Coin Credit' ]);
                $update=Users::find($user);
                $update->balance=$total;
                $update->save();
                if($update){
                    $tot=$userraw+1;
                    return response(['data'=> $reward.' Coin Claimed','balance'=>$total,'limit'=>$spinlimit-$tot,'status'=>1]);
                }else{
                    return response(['data'=>'Error to credit','status'=>0]);
                }
        }else
        {
            return response(['data'=>'Today Limit Completed !!','status'=>0]);
        }   
    }
    
    public function credit_app()
    {
        $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $user=$json['mid'];
        $app=$json['tid'];
        $ip=\Request::ip();
         $count = DB::table('transaction')
                    ->where([['taskId','=',$app],['user_id','=',$user]])->count();
                if($count>0){
                  return response(['data'=> 'Coin Already Claimed','status'=>0]);  
                }else{
                    $coin = DB::table('appsname')->where('id',$app)->get();
                    if($coin)
                    {
                        $fetchcoin= Users::find($user);   
                        $currentcoin= $fetchcoin->balance;   
                        $total= $currentcoin+$coin[0]->points;
                        $trns = DB::table('transaction')
                        ->insert(['tran_type'=>'credit',
                                    'user_id'=>$user,
                                    'amount'=>$coin[0]->points,
                                    'taskId'=>$app,
                                    'ip'=>$ip,
                                    'type'=>'App Install',
                                    'remained_balance'=>$total,
                                    'remarks'=>'App Install Coin Credited' ]);
                            $update=Users::find($user);
                            $update->balance=$total;
                            $update->save();
                            if($update){
                                $counttask=DB::table('transaction')->where('taskId','=',$app)->count();
                                if($coin[0]->task_limit!="0" && $counttask>=$coin[0]->task_limit){
                                    DB::table('appsname')->where('id','=',$app)->update(['status'=>1]);
                                }
                                
                                return response(['data'=> $coin[0]->points.' Coin Claimed','balance'=>$total,'status'=>1]);
                            }else{
                                return response(['data'=>'Error to credit','status'=>0]);
                            }
                    } 
                    
                }
    }
    
    public function credit_quiz()
    {
        $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $user=$json['mid'];
        $fill=$json['data'];
        $coin=$json['tid'];
        $ip=\Request::ip();
        
        $count=DB::table('transaction')
        ->where('user_id','=',$user)
        ->where('quiz','!=',null)
        ->whereDate('inserted_at',Carbon::now())
        ->count();
        
        if($count>0){
            $av=DB::table('transaction')
            ->where('user_id','=',$user)
            ->where('quiz','!=',null)->get()->first()->quiz;
        }else{
          $av=0;  
        }
       
        $fetchcoin= Users::find($user);   
        $currentcoin= $fetchcoin->balance;   
        $total= $currentcoin+$coin;
            $trns = DB::table('transaction')
            ->insert(['tran_type'=>'credit',
                        'user_id'=>$user,
                        'amount'=>$coin,
                        'quiz'=>$av+$fill,
                        'ip'=>$ip,
                        'type'=>'Quiz',
                        'remained_balance'=>$total,
                        'remarks'=>'Quiz win Bonus' ]);
                $update=Users::find($user);
                $update->balance=$total;
                $update->save();
                if($update){
                    return response(['data'=> $coin.' Coin Claimed','balance'=>$total,'status'=>1]);
                }else{
                    return response(['data'=>'Error to credit','status'=>0]);
                }
                
    }
    
   public function credit_game()
    {
         $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $user=$json['mid'];
        $game=$json['tid'];
        $ip=\Request::ip();
         $now = Carbon::now();
         $count = DB::table('transaction')
                    ->where([['game','=',$game],['user_id','=',$user]])
                     ->whereDate('inserted_at',$now)
                    ->count();
                if($count>0){
                  return response(['data'=> 'Coin Already Claimed','status'=>0]);  
                }
                else
                {
                     $j=  json_decode(DB::table('app_setting')->where('id',1)->get()->first()->game);
                     $coin =$j[0]->game_coin ;
                    $update= Users::find($user);   
                    $currentcoin= $update->balance;   
                    $total= $currentcoin+$coin;
                        $trns = DB::table('transaction')
                        ->insert(['tran_type'=>'credit',
                                    'user_id'=>$user,
                                    'amount'=>$coin,
                                    'game'=>$game,
                                    'ip'=>$ip,
                                    'type'=>'Game',
                                    'remained_balance'=>$total,
                                    'remarks'=>'Game Bonus Credited' ]);
                            $update->balance=$total;
                            $update->save();
                            if($update){
                                return response(['data'=> $coin.' Coin Bonus Claimed','balance'=>$total,'status'=>1]);
                            }else{
                                return response(['data'=>'Error to credit','status'=>0]);
        
                            }         
                }
    }
    
   public function debit_half()
    {
        $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $id=$json['mid'];
        $type=$json['tid'];
        $info= DB::table('app_setting')->get();
        $quiz=json_decode($info[0]->quiz);
        if($type==1){
            $coin=$quiz[0]->quiz_skip;
        }else if($type==2){
            $coin=$quiz[0]->quiz_half;
        }else if($type==3){
            $coin=$info[0]->paid_spin;
        }
        
        $update= Users::find($id);   
        $currentcoin= $update->balance;   
        $total= $currentcoin-$coin;
        $update->balance=$total;
        $update->save();
        if($update){
             if($type==1){
                return response(['data'=> $coin.' Coin Debited','balance'=>$total,'status'=>1]);
            }else if($type==2){
                return response(['data'=> 'Lifeline Used','balance'=>$total,'status'=>1]);
            }else if($type==3){
                return response(['data'=> 'Spin Chance Purchased','balance'=>$total,'status'=>1]);
            }
        }else{
            return response(['data'=>'Error to credit','status'=>0]);
        }
    }
    
   public function cpa(){
        return "test";
    }
    
}
