<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Users;
use App\Models\Slider;
use App\Models\Apps;
use App\Models\Video;
use App\Models\CoinStore;
use App\Models\Transaction;
use App\Models\Weblink;
use App\User;
use Carbon\Carbon;
use DataTables,GeoIP;

class FuncController extends Controller
{

   public function appinfo(Request $req){
      if($req->type=="app"){
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
      }else if($req->type=="video"){
        //   $valid = preg_match("/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/watch\?v\=\w+$/", $req->url);
          $regex_pattern = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/";
          $match;
         if(preg_match($regex_pattern, $req->url, $match)){
            $youtube_id=FuncController::YouTubeGetID($req->url);
             $appicon='http://img.youtube.com/vi/'.$youtube_id.'/sddefault.jpg';
             return response([
                     'appicon'=>$appicon,
                     'appname'=>FuncController::get_title($req->url),
                     'status'=>1
                     ]); 
              }else{
                 return response([
                     'appicon'=>'',
                     'appname'=>'',
                     'status'=>0
                     ]);  
              }
        
      }else if($req->type=="web"){
         $appicon='https://www.google.com/s2/favicons?sz=64&domain_url='.$req->url;
         return response([
                 'appicon'=>$appicon,
                 'appname'=>FuncController::get_title($req->url),
                 'status'=>1
                 ]); 
          }
   }
   
   public function promoinfo(){
     $json= json_decode(base64_decode(base64_decode(request()->data)),true);
      $id=$json['mid'];
     $bal=Users::where('cust_id','=',$id)->get()->first()->balance;  
     $info = DB::table('app_setting')->where('id',1)->get();  

     return response([
         'max_promote'=>$info[0]->max_promote,
         'app_promotecoin'=>$info[0]->app_promotecoin,
         'video_promotecoin'=>$info[0]->video_promotecoin,
         'usebal'=>$bal,
         'status'=>1
         ]);
       
   }
   
   public function createPromo(Request $req){
       $ip=\Request::ip();
       $now = Carbon::now();
       $type=$req->type;
       $userid=$req->id;
       $info = DB::table('app_setting')->where('id',1)->get();
       $userbal=Users::where('cust_id','=',$userid)->get()->first()->balance;
       $promote=$req->limit;
       $maxpromote=$info[0]->max_promote;
       
       if($req->type=="app"){
           $coin=$info[0]->app_promotecoin;
       }else{
          $coin=$info[0]->video_promotecoin; 
       }
       
       if(!($promote * $coin <= $userbal)){
           return response(['data'=>'Not Enough Coin','status'=>0]);
       }
       
       if($promote > $maxpromote){
           return response(['data'=>'Max Promote Limit is'.$maxpromote,'status'=>0]);
       }

       if($type=="app"){
            $app = new Apps;
            $app->app_name=$req->title;
            $app->image=$req->thumb;
            $app->points=$info[0]->promo_appcoin;
            $app->url=str_replace("https://play.google.com/store/apps/details?id=", "", $req->url);
            $app->appurl=$req->url;
            $app->task_limit=$promote;
            $app->type="User";
            $app->userid=$userid;
            $res=$app->save();
           
            $trns = DB::table('transaction')
            ->insert(['tran_type'=>'debit',
                      'user_id'=>$userid,
                      'amount'=>$promote*$coin,
                      'ip'=>$ip,
                      'type'=>'App Promotion',
                      'remained_balance'=>$userbal-$promote*$coin,
                      'inserted_at'=>$now,
                      'remarks'=>'App Promotion Created' ]);
                $update=Users::find($userid);
                $update->balance=$userbal-$promote*$coin;
                $doupdate= $update->save();
         
                 if($res && $trns && $doupdate){
                        return response(['data'=>'Promotion Create Successfully','balance'=>$userbal-$promote*$coin,'status'=>1]);
                 }else{
                        return response(['data'=>'Technical Error','status'=>0]);
                }      
       }
       else if($type=="video"){
            $video= new Video;
            $video->title=$req->title;
            $video->thumb=$req->thumb;
            $video->video_id=FuncController::YouTubeGetID($req->url);
            $video->timer=$info[0]->promote_time;
            $video->point=$info[0]->promo_videocoin;
            $video->task_limit=$promote;
            $video->type="User";
            $video->userid=$userid;
            $video->url=$req->url;
            $res=$video->save();
           
            $trns = DB::table('transaction')
            ->insert(['tran_type'=>'debit',
                      'user_id'=>$userid,
                      'amount'=>$promote*$coin,
                      'ip'=>$ip,
                      'type'=>'Video Promotion',
                      'remained_balance'=>$userbal-$promote*$coin,
                      'inserted_at'=>$now,
                      'remarks'=>'Video Promotion Created' ]);
                $update=Users::find($userid);
                $update->balance=$userbal-$promote*$coin;
                $doupdate= $update->save();
         
                 if($res && $trns && $doupdate){
                        return response(['data'=>'Promotion Create Successfully','balance'=>$userbal-$promote*$coin,'status'=>1]);
                 }else{
                        return response(['data'=>'Technical Error','status'=>0]);
                } 
       }
       else if($type=="web"){
           $weblink= new Weblink;
           $weblink->title=$req->title;
           $weblink->url=$req->url;
           $weblink->thumb=$req->thumb;
           $weblink->point=$info[0]->promo_webcoin;
           $weblink->timer=$info[0]->promote_time;
           $weblink->task_limit=$promote;
           $weblink->type="User";
           $weblink->userid=$userid;
           $res=$weblink->save();
           
            $trns = DB::table('transaction')
            ->insert(['tran_type'=>'debit',
                      'user_id'=>$userid,
                      'amount'=>$promote*$coin,
                      'ip'=>$ip,
                      'type'=>'Website Promotion',
                      'remained_balance'=>$userbal-$promote*$coin,
                      'inserted_at'=>$now,
                      'remarks'=>'Website Promotion Created' ]);
                $update=Users::find($userid);
                $update->balance=$userbal-$promote*$coin;
                $doupdate= $update->save();
         
                 if($res && $trns && $doupdate){
                        return response(['data'=>'Promotion Create Successfully','balance'=>$userbal-$promote*$coin,'status'=>1]);
                 }else{
                        return response(['data'=>'Technical Error','status'=>0]);
                }
           
       }
   }
   
   public function promo_app(){
       $json= json_decode(base64_decode(base64_decode(request()->data)),true);
      $id=$json['mid'];
       $data=Apps::where('userid','=',$id)->get();
       if($data){
            return response(['data'=>$data,'status'=>1]);  
       }else{
           return response(['data'=>'','status'=>0]);  
       }
   }
   
   public function promo_video(){
       $json= json_decode(base64_decode(base64_decode(request()->data)),true);
      $id=$json['mid'];
      $data=Video::where('userid','=',$id)->get();
       if($data){
            return response(['data'=>$data,'status'=>1]);  
       }else{
           return response(['data'=>'','status'=>0]);  
       }
   }
   
   public function promo_web(){
       $json= json_decode(base64_decode(base64_decode(request()->data)),true);
      $id=$json['mid'];
       $data=Weblink::where('userid','=',$id)->get();
       if($data){
            return response(['data'=>$data,'status'=>1]);  
       }else{
           return response(['data'=>'','status'=>0]);  
       }
   }
   
   public function promo_count(Request $req){
       $json= json_decode(base64_decode(base64_decode(request()->data)),true);
      $id=$json['mid'];
      if($json['tid']=="app"){
          $type="taskId";
      }
      else if($json['tid']=="web"){
          $type="webId";
      }
      else if($json['tid']=="video"){
          $type="video_id";
      }
      
      $count=DB::table('transaction')->where($type,'=',$id)->count();
      return response(['data'=>'' , 'status'=>$count]);
   }
   
   public function promo_report(Request $req){
       
       if($req->type=="app"){
          $type="taskId"; 
       }else if($req->type=="web"){
          $type="webId"; 
       }else if($req->type=="video"){
          $type="video_id"; 
       }
       
       $data= DB::table('transaction')
                ->where($type,'=',$req->id)
                 ->select($type,'inserted_at', DB::raw('count(*) as total'))
                 ->groupBy('inserted_at')
                 ->get();
       return response(['data'=>$data , 'status'=>1]);          
   }
   
   function get_title($url){
      $str = file_get_contents($url);
      if(strlen($str)>0){
        $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
        preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
        return $title[1];
      }
    }
    
   function YouTubeGetID($url){
        if (stristr($url,'youtu.be/'))
            {preg_match('/(https:|http:|)(\/\/www\.|\/\/|)(.*?)\/(.{11})/i', $url, $final_ID); return $final_ID[4]; }
        else 
            {@preg_match('/(https:|http:|):(\/\/www\.|\/\/|)(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $IDD); return $IDD[5]; }
    }
    
  public function CoinStores(){
      $pay= DB::table('app_setting')->get()->first()->pay_info;
      $data=CoinStore::where('status','=',0)->get();
       if($data){
            return response(['data'=>$data,'status'=>1,'info'=>$pay]);  
       }else{
           return response(['data'=>'','status'=>0,'info'=>$pay]);  
       }
  }
  
  public function UpdateTrans(Request $req){
     $json= json_decode(base64_decode(base64_decode(request()->data)),true);
      $pacinfo=CoinStore::find($json['user_id']);
      if($pacinfo){
          DB::table('payment_transaction')->insert([
          'userid'=>$json['mid'],
          'method'=>$json['pwith'],
          'trans_id'=>$json['trid'],
          'coin'=>$json['coin'],
          'amount'=>$pacinfo->currency." ".$json['amt'],
          'status'=>$json['status'],
          'pacinfo'=>$json['pacinfo']
          ]);
          
          $user=Users::find($json['mid']);
          $user->balance=$user->balance+$json['coin'];
          
          DB::table('transaction')->insert([
              'tran_type'=>'credit',
              'type'=>'Coin Purchased',
              'ip'=>\Request::ip(),
              'user_id'=>$json['mid'],
              'amount'=>$json['coin'],
              'remained_balance'=>$user->balance+$json['coin'],
              'remarks'=>'Coin Purchased']);
          
          $data= $user->save();
           
          if($data){
            return response(['data'=>$data,'balance'=>$user->balance+$json['coin'],'status'=>1]);  
           }else{
               return response(['data'=>'','status'=>0]);  
           } 
      }
  }
    
}
