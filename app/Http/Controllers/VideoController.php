<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('video.video');
    }

    public function List(){
        $data=Video::query();

        return DataTables::eloquent($data)
          ->addColumn('DT_RowIndex', function($data){
             return '<input type="checkbox" class="sub_chk" value="'.$data->id.'" data-id="'.$data->id.'">';
             })
         ->addColumn('thumb', function($data){
             return '<a href="'.$data->thumb.'" target="blank"><img src="'.$data->thumb.'" class="img-thumbnail" width="100" height="100"></a> ';
             })    
         ->addColumn('inserted_at', function($data){
             return date('d-m-Y', strtotime($data->insert_at));
             })
         ->addColumn('view', function($data){
             return '<p>'.DB::table('transaction')->where('video_id','=',$data->id)->count().'/'.$data->task_limit;
             }) 
         ->addColumn('status', function($data){
             $status = $data->status;
                    if($status ==0){
                        return '<span class="badge badge-success m-1 status" id="1" data-id="'.$data->cust_id.'">Active</span>
                        ';
                    }else if($status ==1){
                        return '<span class="badge badge-primary m-1 status" id="0" data-id="'.$data->cust_id.'">Completed</span>';  
                    }else{
                        return '<span class="badge badge-danger m-1 status" id="0" data-id="'.$data->cust_id.'">Pause</span>';  
                    }
             })       
         ->addColumn('video_id', function($data){
             return '<a href="'.$data->url.'" target="blank" >Watch Video</a>';
             })  
         ->addColumn('action', function($data){
            return '<div class="table-actions">
                <a href="'.url('/videos/edit/'.$data->id).'" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Edit</button></a>
                <button type="button" class="btn btn-danger remove-video" data-id="'.$data->id.'"  ><i class="ik ik-trash"></i>Delete</button>
              </div>';       
         })    
         ->rawColumns(['DT_RowIndex','thumb','inserted_at','view','status','video_id','action'])      
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
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request->url, $match);
        $youtube_id = $match[1];
        $video= new VIdeo;
        $video->title=$request->name;
        $video->thumb=$request->thumb;
        $video->video_id=$youtube_id;
        $video->timer=$request->timer;
        $video->point=$request->point;
        $video->task_limit=$request->task_limit;
        $video->url=$request->url;
            $res=$video->save();
            if($res){
                return redirect('/videos')->with('success', 'Task Created Successfully!');
            }else{
                return redirect('/videos/create')->with('error', 'Technical Error!');
            }   
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $id)
    {
      return view('video.edit-video',['video'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request->url, $match);
        $youtube_id = $match[1];
        $video= VIdeo::find($request->id);
        $video->title=$request->name;
        $video->thumb=$request->thumb;
        $video->video_id=$youtube_id;
        $video->timer=$request->timer;
        $video->task_limit=$request->task_limit;
        $video->point=$request->point;
        $video->url=$request->url;
            $res=$video->save();
            if($res){
                return redirect('/videos')->with('success', 'Update Successfully!');
            }else{
                return redirect('/videos')->with('error', 'Technical Error!');
            }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
  
     public function destroy($id)
     {
        Video::find($id)->delete();
         return 1;
     }
     
     public function action(Request $req)
    {
        $ids = $req->id;
        if($req->status=='enable'){
           $update =Video::whereIn('id',explode(",",$ids))->update(array('status' =>0)); 
            if($update){
                return 1;
            }else{
                return "not updated";
            }
        }
        else if($req->status=='disable'){
            $update =Video::whereIn('id',explode(",",$ids))->update(array('status' =>2)); 
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }
        else if($req->status=='delete'){
            Video::whereIn('id',explode(",",$ids))->delete(); 
            return 1;
        }
    }
}
