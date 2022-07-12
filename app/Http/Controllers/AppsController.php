<?php

namespace App\Http\Controllers;

use App\Models\Apps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables,Validator;
use Image;
use Illuminate\Support\Facades\Storage;


class AppsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.apps');
    }

    public function List(){
        $data=Apps::query()->orderBy('id','DESC');

        return DataTables::eloquent($data)
         ->editColumn('DT_RowIndex', function($data){
             return '<input type="checkbox" class="sub_chk" value="'.$data->id.'" data-id="'.$data->id.'">';
             })
         ->editColumn('inserted_at', function($data){
             return date('d-m-Y', strtotime($data->inserted_at));
             })
         ->editColumn('view', function($data){
             return '<p>'.DB::table('transaction')->where('taskId','=',$data->id)->count().'/'.$data->task_limit;
             }) 
         ->editColumn('status', function($data){
             $status = $data->status;
                    if($status ==0){
                        return '<span class="badge badge-success m-1 status" id="1" data-id="'.$data->cust_id.'">Active</span>
                        ';
                    }else if($status ==1){
                        return '<span class="badge badge-primary m-1 status" id="0" data-id="'.$data->cust_id.'">Completed</span>';  
                    }else{
                        return '<span class="badge badge-danger m-1 status" id="0" data-id="'.$data->cust_id.'">Disable</span>';  
                    }
             })      
         ->editColumn('image', function($data){
             return '<a href="'.$data->image.'"><img src="'.$data->image.'" alt="An image" width="100" height="70"></a>';  
             })  
         ->editColumn('action', function($data){
             return '<div class="table-actions">
                     <a href="'.url('/apps/edit/'.$data->id).'" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Edit</button></a>   
                     <button type="button" class="btn btn-danger remove-app" data-id="'.$data->id.'" ><i class="ik ik-trash"></i>Delete</button>
                 </div>';
         })
         ->editColumn('appurl', function($data){
            return '<a target="blank" href="'.$data->appurl.'" style="color:blue;">View in App Store</a>';
            }) 
        ->editColumn('details', function($data){
            return '<p style="width:200px;"'.$data->details.'</p>';
            })           
         ->rawColumns(['DT_RowIndex','inserted_at','view','status','appurl','action','details','image'])      
         ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->type=="external"){
            if($request->icon){
                $image = $request->icon;
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
                $filename = preg_replace("/\s+/", '-', $filename);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = time().'.'.$extension;
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(200,200);  
                $image_resize->save('images/'.$fileNameToStore);
                $icon=env('APP_URL').'images/'.$fileNameToStore;
            }else{
               return redirect('/apps/create')->with('error', 'Select Valid App Icon!!');
            }
            
            
        }else{
            $icon=$request->thumb;
        }
  
        $app= new Apps;
        $app->app_name=$request->name;
        $app->image=$icon;
        $app->points=$request->coin;
        $app->url=$request->package;
        $app->appurl=$request->url;
        $app->task_limit=$request->task_limit;
        $app->details=$request->detail;
        $res=$app->save();
            if($res){
                return redirect('/apps')->with('success', 'Task Created Successfully!');
            }else{
                return redirect('/apps/create')->with('error', 'Technical Error!');
            }
      }
  
  
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apps  $apps
     * @return \Illuminate\Http\Response
     */
    public function edit(Apps $id)
    {
        if (strpos($id->url,env('APP_URL')) !== false) {
               $type="play";
            }else{ $type="external";}
         return view('app.edit-app',['data'=>$id,'type'=>$type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apps  $apps
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apps $apps)
    {
        if($request->type=="external"){
            if($request->icon){
                $image = $request->icon;
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
                $filename = preg_replace("/\s+/", '-', $filename);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = time().'.'.$extension;
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(200,200);  
                $image_resize->save('images/'.$fileNameToStore);
                $imagePath = public_path('images/'.explode(env('APP_URL').'images/', $request->thumb));
                if(File::exists($imagePath)){
                    unlink($imagePath);
                }
                $icon=env('APP_URL').'images/'.$fileNameToStore;
            }else{
              $icon=$request->thumb;
            }
            
            
        }else{
            $icon=$request->thumb;
        }
        
       $app= Apps::find($request->id);
       $app->app_name=$request->name;
       $app->image=$request->thumb;
       $app->points=$request->coin;
       $app->url=$request->package;
       $app->appurl=$request->url;
       $app->task_limit=$request->task_limit;
       $app->details=$request->detail;
       $res=$app->save();
           if($res){
               return redirect('/apps')->with('success', 'Update Successfully!');
           }else{
               return redirect('/apps')->with('error', 'Technical Error!');
           }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apps  $apps
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Apps::find($id)->delete();
        return 1;
    }
    
    public function action(Request $req)
    {
        $ids = $req->id;
        if($req->status=='enable'){
           $update =Apps::whereIn('id',explode(",",$ids))->update(array('status' =>0)); 
            if($update){
                return 1;
            }else{
                return "not updated";
            }
        }
        else if($req->status=='disable'){
            $update =Apps::whereIn('id',explode(",",$ids))->update(array('status' =>2)); 
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }
        else if($req->status=='delete'){
            Apps::whereIn('id',explode(",",$ids))->delete(); 
            return 1;
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
