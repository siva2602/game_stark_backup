<?php

namespace App\Http\Controllers;

use App\Models\Weblink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class WeblinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('web.website');
    }

    public function List(){
        $data=Weblink::query();

       return DataTables::eloquent($data)
         ->addColumn('DT_RowIndex', function($data){
             return '<input type="checkbox" class="sub_chk" value="'.$data->id.'" data-id="'.$data->id.'">';
             })
             
         ->addColumn('thumb', function($data){
             return '<a href="'.$data->thumb.'" target="blank"><img src="'.$data->thumb.'" alt="user image" class="rounded-circle img-30 align-top mr-15"></a> ';
         })
        ->addColumn('inserted_at', function($data){
            return date('d-m-Y', strtotime($data->insert_at));
            })
        ->addColumn('view', function($data){
         return '<p>'.DB::table('transaction')->where('webId','=',$data->id)->count().'/'.$data->task_limit;
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
        ->addColumn('action', function($data){
            return '<div class="table-actions">
                <a href="'.url('/websites/edit/'.$data->id).'" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Edit</button></a>
                <button type="button" class="btn btn-danger remove-web" data-id="'.$data->id.'" ><i class="ik ik-trash"></i>Delete</button>
              </div>';     
        })    
        ->rawColumns(['DT_RowIndex','thumb','inserted_at','view','status','action'])      
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
       $weblink= new Weblink;
       $weblink->title=$request->title;
       $weblink->url=$request->url;
       $weblink->thumb='https://www.google.com/s2/favicons?sz=64&domain_url='.$request->url;
       $weblink->point=$request->point;
       $weblink->timer=$request->timer;
       $weblink->task_limit=$request->task_limit;
       $res=$weblink->save();

            if($res){
                return redirect ('/websites')->with('success','Data Added Successfully');
            }else{
                return redirect ('/websites')->with('error','Technical Error!');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Weblink  $weblink
     * @return \Illuminate\Http\Response
     */
    public function show(Weblink $weblink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Weblink  $weblink
     * @return \Illuminate\Http\Response
     */
    public function edit(Weblink $id)
    {
       return view('web.edit-web',['web'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Weblink  $weblink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Weblink $weblink)
    {
        $weblink= Weblink::find($request->id);
       $weblink->title=$request->title;
       $weblink->url=$request->url;
       $weblink->thumb=$request->thumb;
       $weblink->point=$request->point;
       $weblink->task_limit=$request->task_limit;
       $weblink->timer=$request->timer;
       $res=$weblink->save();

            if($res){
                return redirect ('/websites')->with('success','Update Successfully');
            }else{
                return redirect ('/websites')->with('error','Technical Error!');
            } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Weblink  $weblink
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Weblink::find($id)->delete();
        return 1;
    }
    
    public function action(Request $req)
    {
        $ids = $req->id;
        if($req->status=='enable'){
           $update =Weblink::whereIn('id',explode(",",$ids))->update(array('status' =>0)); 
            if($update){
                return 1;
            }else{
                return "not updated";
            }
        }
        else if($req->status=='disable'){
            $update =Weblink::whereIn('id',explode(",",$ids))->update(array('status' =>2)); 
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }
        else if($req->status=='delete'){
            Weblink::whereIn('id',explode(",",$ids))->delete(); 
            return 1;
        }
    }
}
