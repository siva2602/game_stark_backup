<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\Users;
use OneSignal;
use Image;
use File;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{

   public function new(Request $request){
       
      if($request->url==null){
          $url=null;
      }else{
         $url=$request->url;  
      }
      
      if(isset($request->icon))
        {
            $image = $request->icon;
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
            $filename = preg_replace("/\s+/", '-', $filename);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(400,200);  
            $save= $image_resize->save('images/'.$fileNameToStore);
            $image=env('APP_URL').'images/'.$fileNameToStore;
        }
        else
        {
         $image=null; 
        }

            $result=   OneSignal::sendNotificationToAll(
                        $request->message,
                        $url = $url, 
                        $data = null, 
                        $buttons = null, 
                        $schedule = null,
                        $request->title,
                        $subtitle = null,
                        $image
                    );
            
        return redirect('/notification')->with('success','Notification Send Successfully');
   }


    public function notifyUser(Request $request){
        $token=Users::find($request->id);
        $userId=$token->p_token;
     
        $title=$request->title;
        $message = $request->message;

     $res=  OneSignal::sendNotificationToUser(
            $message,
            $userId,
            $url = null,
            $data = null,
            $buttons = null,
            $schedule = null,
            $headings = $title, 
            $subtitle = null
        );
        
     return redirect('/search-user')->with('success',$res.'Notification Send Successfully');
    }
    
    public static function offernotifyUser($token,$title,$message){
   
      OneSignal::sendNotificationToUser(
            $message,
            $token,
            $url = null,
            $data = null,
            $buttons = null,
            $schedule = null,
            $headings = $title, 
            $subtitle = null
        );
    }
}
