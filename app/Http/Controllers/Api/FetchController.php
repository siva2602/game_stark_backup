<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Users;
use App\Models\Offerwall;
use App\Models\Slider;
use App\User;
use Carbon\Carbon;
use DataTables,GeoIP;
class FetchController extends Controller
{
    
    public function fetch_web(){
       $json= json_decode(base64_decode(base64_decode(request()->data)),true);
       $id=$json['mid'];
        $info=DB::table('app_setting')->where('id',1)->get();
        $limit=$info[0]->limit_web;
        $count=DB::table('transaction')
        ->where('user_id','=',$id)
        ->where('webId','!=',null)
        ->whereDate('inserted_at',Carbon::now())
        ->count();
        
        $available=$limit-$count;
        if($available>0){
            if($info[0]->limit_web=="onetime"){
                $data= DB::select('Select weblink.id,title,url,status,point,timer,thumb,task_limit from weblink 
           left outer join transaction on transaction.user_id =:ids and weblink.id = transaction.webId
            where transaction.webId is NULL and weblink.status=0 ORDER BY weblink.id DESC limit :lim', ['ids' => $id,'lim'=>$available]);
            }
            else{
               $data= DB::select('Select  weblink.id,title,url,status,point,timer,thumb,task_limit,tr.inserted_at from weblink left outer join (select * from (select (row_number() over(partition by webId order by inserted_at DESC)) rn, webId,inserted_at,user_id from transaction)t where t.rn=1)tr on tr.user_id =:ids and weblink.id = tr.webId where weblink.status=0 and (CAST(tr.inserted_at AS DATE) != CURRENT_DATE or tr.inserted_at is null) limit :lim', ['ids' => $id,'lim'=>$available]);  
            }
            
            if($data){
                return response(['data'=>$data,'status'=>1]);  
            }else{
                return response(['data'=>'Data Not Found', 'status'=>0]);
            }
        }else{
            return response(['data'=>'Data Not Found', 'status'=>0]);
        } 
    }
    
    public function fetch_video(){
        $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $id=$json['mid'];
        $info=DB::table('app_setting')->where('id',1)->get();
        $limit=$info[0]->limit_video;
        $count=DB::table('transaction')
        ->where('user_id','=',$id)
        ->where('video_id','!=',null)
        ->whereDate('inserted_at',Carbon::now())
        ->count();
        
        $available=$limit-$count;
        if($available>0){
           if($info[0]->limit_web=="onetime"){
               $data= DB::select('Select youtube_video.id,title,youtube_video.video_id,timer,status,point,url,thumb,task_limit from youtube_video 
            left outer join transaction on transaction.user_id =:ids and
            youtube_video.id = transaction.video_id  where transaction.video_id is NULL and status=0 ORDER BY youtube_video.id DESC limit :lim', ['ids' => $id,'lim'=>$available]);
           }else{
               $data=DB::select('Select youtube_video.id,url,title,youtube_video.video_id,timer,status,point,thumb,tr.inserted_at from youtube_video left outer join (select * from (select (row_number() over(partition by video_id order by inserted_at DESC)) rn, video_id,inserted_at,user_id from transaction)t where t.rn=1)tr on tr.user_id =:ids and youtube_video.id = tr.video_id where youtube_video.status=0 and (CAST(tr.inserted_at AS DATE) != CURRENT_DATE or tr.inserted_at is null) ORDER BY youtube_video.id DESC  limit :lim', ['ids' => $id,'lim'=>$available]);    
           }
 
          
            if($data){
                return response(['data'=>$data,'status'=>1]);  
            }else{
                return response(['data'=>'Data Not Found', 'status'=>0]);
            }  
        }else{
            return response(['data'=>'Data Not Found', 'status'=>0]);
        }
    }
 
    public function fetch_quiz(){
        $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $id=$json['mid'];
        $cat=$json['tid'];
        $info=DB::table('app_setting')->where('id',1)->get();
        $limit=$info[0]->limit_quiz;
        
        
        $count=DB::table('transaction')
        ->where('user_id','=',$id)
        ->where('quiz','!=',null)
        ->whereDate('inserted_at',Carbon::now())
        ->count();
        
        if($count>0){
            // DB::table('select SUM(quiz) as num from table transaction where');
            $av=DB::table('transaction')
            ->where('user_id','=',$id)
            ->where('quiz','!=',null)
            ->whereDate('inserted_at',Carbon::now())
            ->sum('quiz');
        }else{
          $av=0;  
        }
        
        $available=$limit-$av;

        if($available>0){
            if($available>10){
                $available=10;
            }else{
               $available=$available; 
            }
            
            $data= DB::select('Select * from quiz where status=0 and category=? ORDER BY rand() DESC limit ?', [$cat,$available]); 
            
            if($data){
                return response(['data'=>$data,'message'=>'','status'=>1]);  
            }else{
                return response(['data'=>[],'message'=>'Try with Different Category', 'status'=>0]);
            }
        }else{
            return response(['data'=>[],'message'=>'Today Quiz Limit Completed', 'status'=>0]);
        } 
    }
    
    public function fetch_game(){
         $info= DB::table('app_setting')->get();
         $game=json_decode($info[0]->game);
         $data= DB::select('Select * from games where status=0 ORDER BY id DESC');
            if($data){
                return response(['data'=>$data,'game_minute'=>$game[0]->game_minute,'game_message'=>$game[0]->game_message,'status'=>1]);  
            }else{
                return response(['data'=>'Data Not Found','game_minute'=>$game[0]->game_minute,'game_message'=>$game[0]->game_message,'status'=>0]);
            }
    }

    public function fetch_apps(){
          $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $id=$json['mid'];
        $limit=DB::table('app_setting')->where('id',1)->get()->first()->limit_app;
        $count=DB::table('transaction')
        ->where('user_id','=',$id)
        ->where('taskId','!=',null)
        ->whereDate('inserted_at',Carbon::now())
        ->count();
        
        $available=$limit-$count;
        if($available>0){
            $data= DB::select('Select appsname.id,app_name,image,points,url,status,appurl,details,task_limit from appsname 
        left outer join transaction on transaction.user_id =:ids and
        appsname.id = transaction.taskId  where transaction.taskId is NULL and status=0 ORDER BY appsname.id DESC limit :lim', ['ids' => $id,'lim'=>$available]);
            if($data){
                return response(['data'=>$data,'status'=>1]);  
            }else{
                return response(['data'=>'Data Not Found', 'status'=>0]);
            }
        }else{
            return response(['data'=>'Data Not Found', 'status'=>0]);
        } 
     }
    
    public function fetch_rewards_category(){
      $data= DB::select('Select * from redeem_cat where status=0');
            if($data){
                return response(['data'=>$data,'status'=>1]);  
            }else{
                return response(['data'=>'Data Not Found', 'status'=>0]);
            }  
    }    

    public function fetch_rewards(){
         $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $id=$json['tid'];
        $data= DB::select('Select * from redeem where status=0 and category='.$id);
            if($data){
                return response(['data'=>$data,'status'=>1]);  
            }else{
                return response(['data'=>'Data Not Found', 'status'=>0]);
            }
     }
     
     public function QuizCat(){
        $data= DB::table('quiz_cat')->where('status',0)->get();
        if($data){
            $info= DB::table('app_setting')->get();
            $quiz=json_decode($info[0]->quiz);
            return response(['data'=>$data,'quiz_time'=>$quiz[0]->quiz_time,'lifeline'=>$quiz[0]->quiz_half,'quiz_skip'=>$quiz[0]->quiz_skip,'status'=>1]);  
        }else{
            return response(['data'=>'Data Not Found','quiz_time'=>'','lifeline'=>'' ,'quiz_skip'=>'','status'=>0]);
        }
     }

    public function fetch_transactions(){
        $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $id=$json['mid'];
        $lastid=$json['tid'];
        if($lastid!=0){
            $data= DB::select('SELECt * from transaction where user_id=:uid AND id < :lastid order by id desc limit 30', ['uid' => $id,'lastid'=>$lastid]);
                if($data){
                      return response(['data'=>$data,'status'=>1]);  
                }else{
                    return response(['data'=>'Data Not Found', 'status'=>0]);
                }
        } else {
            $data= DB::select('select * from transaction where user_id =:uid order by id desc limit 30', ['uid' => $id]);
                if($data){
                        return response(['data'=>$data,'status'=>1]);  
                    }else{
                        return response(['data'=>'Data Not Found', 'status'=>0]);
                    }
        }
     }
     
    public function fetch_reward_trans(){
        $id=request()->mid;
        $data= DB::select('select * from recharge_request where user_id =:uid order by request_id desc limit 10', ['uid' => $id]);
        if($data){
                return response(['data'=>$data,'status'=>1]);  
            }else{
                return response(['data'=>'Data Not Found', 'status'=>0]);
            }
    }
    
    public function fetch_offerwall(){
        $data= Offerwall::where('status',0)->get();
        if($data){
                return response(['data'=>$data,'status'=>1]);  
            }else{
                return response(['data'=>'Data Not Found', 'status'=>0]);
            }
    }

    public function spinlimit(){
        $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $id=$json['mid'];
        $now = Carbon::now();
        $info=DB::table('app_setting')->where('id',1)->get();
        $spinlimit=$info[0]->spinlimit;
        $userraw = DB::table('transaction')
        ->where(['user_id'=>$id,'spinhit'=>1])
        ->whereDate('inserted_at',$now)
        ->count();

        if($userraw<=$spinlimit){
            return response(['data'=>$spinlimit-$userraw,'info'=>$info[0]->paid_spin,'status'=>1]);
        }else{
            return response(['data'=>'0','info'=>$info[0]->paid_spin,'status'=>0]);
        }
     }
     
    public function scratchlimit(){
         $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $id=$json['mid'];
        $now = Carbon::now();
        $info=DB::table('app_setting')->where('id',1)->get();
        $spinlimit = $info[0]->scrath_limit;
        $userraw = DB::table('transaction')
        ->where(['user_id'=>$id,'scrath'=>1])
        ->whereDate('inserted_at',$now)
        ->count();

        if($userraw<=$spinlimit){
            return response(['data'=>$spinlimit-$userraw,'info'=>$info[0]->scratch,'status'=>1]);
        }else{
            return response(['data'=>'0','info'=>$info[0]->scratch,'status'=>0]);
        }
     }
     
    public function DailyMission(){
      $json= json_decode(base64_decode(base64_decode(request()->data)),true);
        $id=$json['mid'];  
        $info=DB::table('app_setting')->where('id',1)->get();
        $scratch = $info[0]->scrath_limit;
        $spin = $info[0]->spinlimit;
        $app = $info[0]->limit_app;
        $video = $info[0]->limit_video;
        $quiz = $info[0]->limit_quiz;
        $web = $info[0]->limit_web;
        
        
        $scratchcount = DB::table('transaction')
        ->where(['user_id'=>$id,'scrath'=>1])
        ->whereDate('inserted_at',Carbon::now())
        ->count();
        
        $spincount = DB::table('transaction')
        ->where(['user_id'=>$id,'spinhit'=>1])
        ->whereDate('inserted_at',Carbon::now())
        ->count();
        
        $Appcount=DB::table('transaction')
        ->where('user_id','=',$id)
        ->where('taskId','!=',null)
        ->whereDate('inserted_at',Carbon::now())
        ->count();
        
         $Quizcount=DB::table('transaction')
        ->where('user_id','=',$id)
        ->where('quiz','!=',null)
        ->whereDate('inserted_at',Carbon::now())
        ->count();
        
        if($Quizcount>0){
            // DB::table('select SUM(quiz) as num from table transaction where');
            $av=DB::table('transaction')
            ->where('user_id','=',$id)
            ->where('quiz','!=',null)
            ->whereDate('inserted_at',Carbon::now())
            ->sum('quiz');
        }else{
          $av=0;  
        }
        
       $Videocount=DB::table('transaction')
        ->where('user_id','=',$id)
        ->where('video_id','!=',null)
        ->whereDate('inserted_at',Carbon::now())
        ->count();
        
        $Webcount=DB::table('transaction')
        ->where('user_id','=',$id)
        ->where('webId','!=',null)
        ->whereDate('inserted_at',Carbon::now())
        ->count();
        
        $dailycount = DB::table('transaction')
        ->where('user_id','=',$id)
        ->where('type','=','Daily Checkin')
        ->whereDate('inserted_at',Carbon::now())
        ->count();
        
         $gamecount = DB::table('transaction')
        ->where('user_id','=',$id)
        ->where('game','!=',null)
        ->whereDate('inserted_at',Carbon::now())
        ->count();
        
        $data=[
            'spin'=>$spincount.'/'.$spin,
            'scratch'=>$scratchcount.'/'.$scratch,
            'app'=>$Appcount.'/'.$app,
            'video'=>$Videocount.'/'.$video,
            'web'=>$Webcount.'/'.$web,
            'quiz'=>$av.'/'.$quiz,
            'dailybonus'=>$dailycount,
            'game'=>$gamecount.'/10'
            ];
        
         return response(['data'=>$data,'status'=>1]);  
   }  
     
    public function about(){
        $data=DB::table('setting')->where('id',1)->get();
        $appsetting=DB::table('app_setting')->where('id',1)->get();
         $spin=DB::table('wheel_points')->get();
            if($data){
                return response(['data'=>$data,'spin'=> $spin, 'google_login'=>$appsetting[0]->google_login,'promote_content'=>$appsetting[0]->promote_content,'email_verification'=>$appsetting[0]->email_verification,'status'=>1]);
            }else{
                return response(['data'=>'data not found!!','google_login'=>'','promote_content'=>'','email_verification'=>'','status'=>0]);
            }
   } 
   
   public function spin(){
    $data= DB::table('wheel_points')->where('id',1)->get();
         if($data){
             return response(['data'=>$data,'status'=>1]);
         }else{
             return response(['data'=>'data not found!!','status'=>0]);
         }
    } 


   public function check(Request $req){
        $admin= User::find(2);
        $licence = base64_decode($admin->licence);
        $package= base64_decode($admin->package);
        
        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,'https://licence.technicalsumer.com/getdataname.php?cpn='.$licence);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $query = curl_exec($curl_handle);
        $data = json_decode($query, true);
        curl_close($curl_handle);
        
        $pac= $data["lists"][0]["package"];
        $lice= $data["lists"][0]["purchase_code"];
            
            if($pac==$req->package && $lice==$licence){
                 return response(['status'=>201 ,'data'=>'valid']);  
            }else{
                return response(['status'=>400 ,'data'=>'notvalid']);
            }
        }
        
   public function faq($type){
        $data= DB::select('Select * from faq where type=:ty', ['ty' => $type]);
            if($data){
                return response(['data'=>$data,'status'=>1]);  
            }else{
                return response(['data'=>'Data Not Found', 'status'=>0]);
            }
   } 
   
   public function promotion_banner(){
        $data= Slider::where(['status'=>0])->inRandomOrder()->limit(1)->get();
            if($data){
                return response(['data'=>$data,'status'=>1]);  
            }else{
                return response(['data'=>'Data Not Found', 'status'=>0]);
            }
   }  
   
   public function Homebanner(){
        $data= Slider::where(['status'=>0])->where(['bannertype'=>'slide'])->get();
            if($data){
                return response(['data'=>$data,'status'=>1]);  
            }else{
                return response(['data'=>'Data Not Found', 'status'=>0]);
            }
   }     
   
 
   public function appinfo(Request $req){
      $package = str_replace("https://play.google.com/store/apps/details?id=", "", $req->url);
      $gplay = new \Nelexa\GPlay\GPlayApps();
      $exists = $gplay->existsApp($package);
     
      if($exists){
         $appInfo = $gplay->getAppInfo($package);
         return response([
             'appicon'=>$appInfo->getIcon()->getUrl(),
             'appname'=>$appInfo->getName(),
             'status'=>1
             ]); 
      }else{
         return response([
             'appicon'=>'',
             'appname'=>'',
             'status'=>0
             ]);  
      }
   }

}
