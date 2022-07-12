<?php

namespace App\Http\Controllers;

use App\Models\Offerwall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables,Validator;
use Image;
use Illuminate\Support\Facades\Storage;
use File;

class OfferwallC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('game.game');
    }

     public function Data($type){
        if($type=="sdk"){
            $data=Offerwall::query()->where('type','sdk');

            return DataTables::eloquent($data)
              ->addColumn('DT_RowIndex', function($data){
                 return '<input type="checkbox" class="sub_chk" value="'.$data->id.'" data-id="'.$data->id.'">';
                 })
             ->addColumn('status', function($data){
                 $status = $data->status;
                        if($status ==0){
                            return '<span class="badge badge-success m-1">Active</span>
                            ';
                        }else{
                            return '<span class="badge badge-danger m-1 ">Disable</span>';  
                        }
                 })          
             ->addColumn('thumb',function($data){
                 return '<img src="'.url('images/'.$data->thumb).'" alt="An image" height="100px">';
             })
             ->addColumn('action', function($data){
                 $pb=  DB::table('postback')->where('offerwall_id',$data->id)->get()->first()->postback_url;
                return '<div class="table-actions">
                     <button type="button" class="btn btn-dark copy-postback" data-id="'.env('APP_URL').$pb.'" > <i class="ik ik-copy"></i>Copy PostBack</button></a>    
                     <a href="'.url('/offerwall/edit/sdk/'.$data->id).'" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Edit</button></a>    
                  </div>';    
             })
             ->rawColumns(['DT_RowIndex','status','thumb','action'])      
              ->toJson();
        }
        else if($type=="api"){
            $data=Offerwall::query()->where('type','api');

            return DataTables::eloquent($data)
              ->addColumn('DT_RowIndex', function($data){
                 return '<input type="checkbox" class="sub_chk" value="'.$data->id.'" data-id="'.$data->id.'">';
                 })
             ->addColumn('status', function($data){
                 $status = $data->status;
                        if($status ==0){
                            return '<span class="badge badge-success m-1">Active</span>
                            ';
                        }else{
                            return '<span class="badge badge-danger m-1 ">Disable</span>';  
                        }
                 })          
             ->addColumn('thumb',function($data){
                 return '<img src="'.url('images/'.$data->thumb).'" alt="An image" height="100px">';
             })
             ->addColumn('action', function($data){
                 $pb=  DB::table('postback')->where('offerwall_id',$data->id)->get()->first()->postback_url;
                return '<div class="table-actions">
                     <button type="button" class="btn btn-dark copy-postback" data-id="'.env('APP_URL').$pb.'" > <i class="ik ik-copy"></i>Copy PostBack</button></a>    
                     <a href="'.url('/offerwall/edit/api/'.$data->id).'" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Edit</button></a>    
                  </div>';    
             })
             ->rawColumns(['DT_RowIndex','status','thumb','action'])      
              ->toJson();
        }
        else if($type=="web"){
            $data=Offerwall::query()->where('type','web');

            return DataTables::eloquent($data)
              ->addColumn('DT_RowIndex', function($data){
                 return '<input type="checkbox" class="sub_chk" value="'.$data->id.'" data-id="'.$data->id.'">';
                 })
             ->addColumn('status', function($data){
                 $status = $data->status;
                        if($status ==0){
                            return '<span class="badge badge-success m-1">Active</span>
                            ';
                        }else{
                            return '<span class="badge badge-danger m-1 ">Disable</span>';  
                        }
                 })          
             ->addColumn('thumb',function($data){
                 return '<img src="'.url('images/'.$data->thumb).'" alt="An image" height="100px">';
             })
             ->addColumn('action', function($data){
               $pb=  DB::table('postback')->where('offerwall_id',$data->id)->get()->first()->postback_url;
                return '<div class="table-actions">
                     <button type="button" class="btn btn-dark copy-postback" data-id="'.env('APP_URL').$pb.'" > <i class="ik ik-copy"></i>Copy PostBack</button></a>    
                     <a href="'.url('/offerwall/edit/web/'.$data->id).'" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Edit</button></a>    
                  </div>';    
             })
             ->rawColumns(['DT_RowIndex','status','thumb','action'])      
              ->toJson();
        }
    }
    

   
    public function store(Request $request)
    {
        if($request->offerwall_type=="sdk"){
            $image = $request->icon;
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
            $filename = preg_replace("/\s+/", '-', $filename);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore = uniqid().'_'.time().'.'.$extension;
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200,200);
            $save= $image_resize->save('images/'.$fileNameToStore);
         
           $data=array([
                'offername'=>$request->offername,
                'placement'=>$request->placement,
                'appid'=>$request->appid,
                'token'=>$request->token
                ]);
            if($request->userid!=""){ $puser=''.$request->userid; }else{$puser='';}
            if($request->appid!=""){ $pappid='&'.$request->appid; }else{$pappid='';}
            if($request->amount!=""){ $pamount='&'.$request->amount; }else{$pamount='';}
            if($request->p_offername!=""){ $p_offername='&'.$request->p_offername; }else{$p_offername='';}
            if($request->offerid!=""){ $pofferid='&'.$request->offerid; }else{$pofferid='';}
            if($request->ip!=""){ $pip='&'.$request->ip; }else{$pip='';}
                
            $offer= new Offerwall;
            $offer->title=$request->title;
            $offer->thumb=$fileNameToStore;
            $offer->description=$request->description;
            $offer->data=json_encode($data);;
            $offer->type='sdk';
            $res=$offer->save();
            $id=$offer->id;
             $domainURL = 'api/v1/offer_cr/'.$id.'?signs='.env('OFFERWALL_KEY').'&';
            $ins=DB::table('postback')->insert([
                'offerwall_id'=>$id,
                'postback_url'=>$domainURL.$puser.$pamount.$pip.$pofferid.$p_offername,
                'offerwall_name'=>$request->offername,
                'p_userid'=>$request->userid,
                'p_payout'=>$request->amount,
                'p_campaing_id'=>$request->offerid,
                'p_ip'=>$request->ip,
                'p_offername'=>$request->p_offername
                ]);
            if($ins){
                return redirect('/offerwall/sdk')->with('success', 'Network Created Successfully!');
            }else{
                return redirect('/offerwall/sdk')->with('error', 'Technical Error!');
            }  
        }
        else if($request->offerwall_type=="api"){
            $image = $request->icon;
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
            $filename = preg_replace("/\s+/", '-', $filename);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore = uniqid().'_'.time().'.'.$extension;
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200,200);
            $save= $image_resize->save('images/'.$fileNameToStore);
         
           $data=array([
                'offername'=>$request->offername,
                'offer_api_url'=>$request->offer_api_url,
                'header'=>$request->header,
                'json_array'=>$request->json_array,
                'key_campid'=>$request->key_campid,
                'key_title'=>$request->key_title,
                'key_description'=>$request->key_description,
                'key_amount'=>$request->key_amount,
                'key_icon_url'=>$request->key_icon_url,
                'key_offer_link'=>$request->key_offer_link,
                'key_extra_suffix'=>$request->key_extra_suffix,
                'userid'=>$request->userid
              ]);
            if($request->userid!=""){ $puser=''.$request->userid; }else{$puser='';}
            if($request->amount!=""){ $pamount='&'.$request->amount; }else{$pamount='';}
            if($request->p_offername!=""){ $p_offername='&'.$request->p_offername; }else{$p_offername='';}
            if($request->offerid!=""){ $pofferid='&'.$request->offerid; }else{$pofferid='';}
            if($request->ip!=""){ $pip='&'.$request->ip; }else{$pip='';}
                
            $offer= new Offerwall;
            $offer->title=$request->title;
            $offer->thumb=$fileNameToStore;
            $offer->description=$request->description;
            $offer->data=json_encode($data);;
            $offer->type='api';
            $res=$offer->save();
            $id=$offer->id;
             $domainURL = 'api/v1/offer_cr/'.$id.'?signs='.env('OFFERWALL_KEY').'&';
            $ins=DB::table('postback')->insert([
                'offerwall_id'=>$id,
                'postback_url'=>$domainURL.$puser.$pamount.$pip.$pofferid.$p_offername,
                'offerwall_name'=>$request->offername,
                'p_userid'=>$request->userid,
                'p_payout'=>$request->amount,
                'p_campaing_id'=>$request->offerid,
                'p_ip'=>$request->ip,
                'p_offername'=>$request->p_offername
                ]);
            if($ins){
                return redirect('/offerwall/api')->with('success', 'Network Created Successfully!');
            }else{
                return redirect('/offerwall/api')->with('error', 'Technical Error!');
            }  
        }
        else if($request->offerwall_type=="web"){
            $image = $request->icon;
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
            $filename = preg_replace("/\s+/", '-', $filename);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore = uniqid().'_'.time().'.'.$extension;
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200,200);
            $save= $image_resize->save('images/'.$fileNameToStore);
         
           $data=array([
                'offername'=>$request->offername,
                'offerwall_url'=>$request->offerwall_url,
                'header'=>$request->header,
                'userid'=>$request->userid
                ]);
             $domainURL = 'api/v1/offer_cr/'.$id.'?signs='.env('OFFERWALL_KEY').'&';
            if($request->userid!=""){ $puser=''.$request->userid; }else{$puser='';}
            if($request->amount!=""){ $pamount='&'.$request->amount; }else{$pamount='';}
            if($request->p_offername!=""){ $p_offername='&'.$request->p_offername; }else{$p_offername='';}
            if($request->offerid!=""){ $pofferid='&'.$request->offerid; }else{$pofferid='';}
            if($request->ip!=""){ $pip='&'.$request->ip; }else{$pip='';}
                
            $offer= new Offerwall;
            $offer->title=$request->title;
            $offer->thumb=$fileNameToStore;
            $offer->description=$request->description;
            $offer->data=json_encode($data);;
            $offer->type='web';
            $res=$offer->save();
            $id=$offer->id;
            $ins=DB::table('postback')->insert([
                'offerwall_id'=>$id,
                'postback_url'=>$domainURL.$puser.$pamount.$pip.$pofferid.$p_offername,
                'offerwall_name'=>$request->offername,
                'p_userid'=>$request->userid,
                'p_payout'=>$request->amount,
                'p_campaing_id'=>$request->offerid,
                'p_ip'=>$request->ip,
                'p_offername'=>$request->p_offername
                ]);
                if($ins){
                    return redirect('/offerwall/web')->with('success', 'Network Created Successfully!');
                }else{
                    return redirect('/offerwall/web')->with('error', 'Technical Error!');
                }  
        }

    }
   
   
  public function edit($type,Offerwall $id)
    {
      if($type=="sdk"){
          $decode= json_decode($id->data);
          return view('offerwall.edit-offer-sdk',[
              'data'=>$id,
              'offername'=>$decode[0]->offername,
              'placement'=>$decode[0]->placement,
              'appid'=>$decode[0]->appid,
              'token'=>$decode[0]->token ,
              'pb'=>DB::table('postback')->where('offerwall_id',$id->id)->get()]);
      }
      else if($type=="api"){
          $decode= json_decode($id->data);
          return view('offerwall.edit-offer-api',[
              'data'=>$id,
              'offername'=>$decode[0]->offername,
              'offer_api_url'=>$decode[0]->offer_api_url,
              'header'=>$decode[0]->header,
              'json_array'=>$decode[0]->json_array,
              'key_campid'=>$decode[0]->key_campid,
              'key_title'=>$decode[0]->key_title,
              'key_description'=>$decode[0]->key_description,
              'key_amount'=>$decode[0]->key_amount,
              'key_icon_url'=>$decode[0]->key_icon_url,
              'key_offer_link'=>$decode[0]->key_offer_link,
              'key_extra_suffix'=>$decode[0]->key_extra_suffix,
              'pb'=>DB::table('postback')->where('offerwall_id',$id->id)->get()]);
      }
      else if($type=="web"){
          $decode= json_decode($id->data);
          return view('offerwall.edit-offer-web',[
              'data'=>$id,
              'offername'=>$decode[0]->offername,
              'offerwall_url'=>$decode[0]->offerwall_url,
              'header'=>$decode[0]->header,
              'pb'=>DB::table('postback')->where('offerwall_id',$id->id)->get()]);
      }
    }

     
    public function update(Request $request, Offerwall $offer)
    {
        if($request->offerwall_type=="sdk"){
            if(isset($request->icon))
            {
                $image = $request->icon;
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
                $filename = preg_replace("/\s+/", '-', $filename);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = uniqid().'_'.time().'.'.$extension;
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(200,200);
                $save= $image_resize->save('images/'.$fileNameToStore);
                $icon=$fileNameToStore;
                $imagePath = public_path('images/'.$request->oldimage);
                if(File::exists($imagePath)){
                   unlink($imagePath);
                }
            }
            else
            {
             $icon=$request->oldimage; 
            }
            
            if($request->userid!=""){ $puser=''.$request->userid; }else{$puser='';}
            if($request->appid!=""){ $pappid='&'.$request->appid; }else{$pappid='';}
            if($request->amount!=""){ $pamount='&'.$request->amount; }else{$pamount='';}
            if($request->p_offername!=""){ $pextra_one='&'.$request->p_offername; }else{$p_offername='';}
            if($request->offerid!=""){ $pofferid='&'.$request->offerid; }else{$pofferid='';}
            if($request->ip!=""){ $pip='&'.$request->ip; }else{$pip='';}
            if($request->status=="on"){ $status='0';}else{$status='1';}
            
            $data=array([
                'offername'=>$request->offername,
                'placement'=>$request->placement,
                'appid'=>$request->appid,
                'token'=>$request->token]);
                
            $offer= Offerwall::find($request->id);
            $offer->title=$request->title;
            $offer->description=$request->description;
            $offer->status=$status;
            $offer->data=$data;
            $offer->thumb=$icon;
            $res=$offer->save();
             $domainURL = 'api/v1/offer_cr/'.$request->id.'?signs='.env('OFFERWALL_KEY').'&';

            $ins=DB::table('postback')->where('offerwall_id',$request->id)->update([
                'postback_url'=>$domainURL.$puser.$pamount.$pip.$pofferid.$p_offername,
                'offerwall_name'=>$request->offername,
                'p_userid'=>$request->userid,
                'p_payout'=>$request->amount,
                'p_campaing_id'=>$request->offerid,
                'p_ip'=>$request->ip,
                'p_offername'=>$request->p_offername
                ]);
            
                if($ins){
                    return redirect('/offerwall/sdk')->with('success', 'Network Update Successfully!');
                }else{
                    return redirect('/offerwall/sdk')->with('error', 'Technical Error!');
                }
        }
        else if($request->offerwall_type=="api"){
            if(isset($request->icon))
            {
                $image = $request->icon;
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
                $filename = preg_replace("/\s+/", '-', $filename);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = uniqid().'_'.time().'.'.$extension;
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(200,200);
                $save= $image_resize->save('images/'.$fileNameToStore);
                $icon=$fileNameToStore;
                $imagePath = public_path('images/'.$request->oldimage);
                if(File::exists($imagePath)){
                  unlink($imagePath);
                }
            }
            else
            {
             $icon=$request->oldimage; 
            }
            
            $data=array([
                'offername'=>$request->offername,
                'offer_api_url'=>$request->offer_api_url,
                'header'=>$request->header,
                'json_array'=>$request->json_array,
                'key_campid'=>$request->key_campid,
                'key_title'=>$request->key_title,
                'key_description'=>$request->key_description,
                'key_amount'=>$request->key_amount,
                'key_icon_url'=>$request->key_icon_url,
                'key_offer_link'=>$request->key_offer_link,
                'key_extra_suffix'=>$request->key_extra_suffix,
                'userid'=>$request->userid
            ]);
            if($request->userid!=""){ $puser=''.$request->userid; }else{$puser='';}
            if($request->amount!=""){ $pamount='&'.$request->amount; }else{$pamount='';}
            if($request->p_offername!=""){ $p_offername='&'.$request->p_offername; }else{$p_offername='';}
            if($request->offerid!=""){ $pofferid='&'.$request->offerid; }else{$pofferid='';}
            if($request->ip!=""){ $pip='&'.$request->ip; }else{$pip='';}
                
            $offer= Offerwall::find($request->id);
            $offer->title=$request->title;
            $offer->thumb=$icon;
            $offer->description=$request->description;
            $offer->data=json_encode($data);;
            $res=$offer->save();
            
             $domainURL = 'api/v1/offer_cr/'.$request->id.'?signs='.env('OFFERWALL_KEY').'&';
             $ins=DB::table('postback')->where('offerwall_id',$request->id)->update([
                'postback_url'=>$domainURL.$puser.$pamount.$pip.$pofferid.$p_offername,
                'offerwall_name'=>$request->offername,
                'p_userid'=>$request->userid,
                'p_payout'=>$request->amount,
                'p_campaing_id'=>$request->offerid,
                'p_ip'=>$request->ip,
                'p_offername'=>$request->p_offername
                ]);
                
                if($ins){
                    return redirect('/offerwall/api')->with('success', 'Network Created Successfully!');
                }else{
                    return redirect('/offerwall/api')->with('error', 'Technical Error!');
                }  
        }
        else if($request->offerwall_type=="web"){
            if(isset($request->icon))
            {
                $image = $request->icon;
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
                $filename = preg_replace("/\s+/", '-', $filename);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = uniqid().'_'.time().'.'.$extension;
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(200,200);
                $save= $image_resize->save('images/'.$fileNameToStore);
                $icon=$fileNameToStore;
                $imagePath = public_path('images/'.$request->oldimage);
                if(File::exists($imagePath)){
                  unlink($imagePath);
                }
            }
            else
            {
             $icon=$request->oldimage; 
            }
            
            $data=array([
                'offername'=>$request->offername,
                'offerwall_url'=>$request->offerwall_url,
                'header'=>$request->header,
                'userid'=>$request->userid                ]);

            if($request->userid!=""){ $puser=''.$request->userid; }else{$puser='';}
            if($request->amount!=""){ $pamount='&'.$request->amount; }else{$pamount='';}
            if($request->p_offername!=""){ $p_offername='&'.$request->p_offername; }else{$p_offername='';}
            if($request->offerid!=""){ $pofferid='&'.$request->offerid; }else{$pofferid='';}
            if($request->ip!=""){ $pip='&'.$request->ip; }else{$pip='';}
                
            $offer= Offerwall::find($request->id);
            $offer->title=$request->title;
            $offer->thumb=$icon;
            $offer->description=$request->description;
            $offer->data=json_encode($data);;
             $res=$offer->save();
             
             $domainURL = 'api/v1/offer_cr/'.$request->id.'?signs='.env('OFFERWALL_KEY').'&';
             $ins=DB::table('postback')->where('offerwall_id',$request->id)->update([
            'postback_url'=>$domainURL.$puser.$pamount.$pip.$pofferid.$p_offername,
            'offerwall_name'=>$request->offername,
            'p_userid'=>$request->userid,
            'p_payout'=>$request->amount,
            'p_campaing_id'=>$request->offerid,
            'p_ip'=>$request->ip,
            'p_offername'=>$request->p_offername
            ]);

            if($res){
                return redirect('/offerwall/web')->with('success', 'Network Created Successfully!');
            }else{
                return redirect('/offerwall/web')->with('error', 'Technical Error!');
            }  
        }
          
 
    }


     public function destroy($id)
    {
        Game::find($id)->delete();
        return 1;
    }
    
    public function action(Request $req)
    {
        $ids = $req->id;
        if($req->status=='enable'){
           $update =Offerwall::whereIn('id',explode(",",$ids))->update(array('status' =>0)); 
            if($update){
                return 1;
            }else{
                return "not updated";
            }
        }
        else if($req->status=='disable'){
            $update =Offerwall::whereIn('id',explode(",",$ids))->update(array('status' =>1)); 
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }
        
    }
}
