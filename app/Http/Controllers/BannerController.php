<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Image;
use File;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.banner');
    }
    
     public function List(){
        $data=Slider::get();

        return DataTables::of($data)
          ->addColumn('DT_RowIndex', function($data){
             return '<input type="checkbox" class="sub_chk" value="'.$data->id.'" data-id="'.$data->id.'">';
             })
         ->addColumn('banner',function($data){
             return '<img src="'.url('images/'.$data->banner).'" alt="An image" height="100px">';
         })
        ->addColumn('status', function($data){
             $status = $data->status;
                    if($status ==0){
                        return '<span class="badge badge-success m-1">Enabled</span>';
                    }else{
                        return '<span class="badge badge-danger m-1 status" id="0">Disabled</span>';  
                    }
             })     
         ->addColumn('action', function($data){
            return '<div class="table-actions">
                 <button type="button" class="btn btn-success edit-banner" data-id="'.$data->id.'"  ><i class="ik ik-edit"></i>Edit</button>
                <button type="button" class="btn btn-danger remove-banner" data-id="'.$data->id.'"  ><i class="ik ik-trash"></i>Delete</button>
              </div>';    
         })
         ->rawColumns(['DT_RowIndex','banner','status','action'])      
         ->make(true);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->icon;
        $filenameWithExt = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
        $filename = preg_replace("/\s+/", '-', $filename);
        $extension = $image->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $image_resize = Image::make($image->getRealPath());
        if($request->bannertype=="banner"){
               $image_resize->resize(400,200);  
            }else {
               $image_resize->resize(400,400);  
            }
        $save= $image_resize->save('images/'.$fileNameToStore);

        if($save){
            $banner= new Slider;
            $banner->onclick=$request->type;
            $banner->link=$request->link;
            $banner->bannertype=$request->bannertype;
            $banner->banner=$fileNameToStore;
            $res=$banner->save();
                if($res){
                    return redirect('/banner')->with('success', 'Task Created Successfully!');
                }else{
                    return redirect('/banner')->with('error', 'Technical Error!');
                }
        }else{
            return redirect('/banner')->with('error', 'Technical Error Image!');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $id)
    {
       return $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
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
            
            if($request->bannertype=="banner"){
               $image_resize->resize(400,200);  
            }else{
               $image_resize->resize(400,400);  
            }
            
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
        
        $banner= Slider::find($request->id);
        $banner->onclick=$request->type;
        $banner->link=$request->link;
        $banner->bannertype=$request->bannertype;
        $banner->banner=$icon;
        $res=$banner->save();
            if($res){
                return redirect('/banner')->with('success', 'Update Successfully!');
            }else{
                return redirect('/banner')->with('error', 'Technical Error!');
            }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Slider::find($id)->delete();
                return 1;
    }
    
    public function action(Request $req)
    {
        $ids = $req->id;
        if($req->status=='enable'){
           $update =Slider::whereIn('id',explode(",",$ids))->update(array('status' =>0)); 
            if($update){
                return 1;
            }else{
                return "not updated";
            }
        }
        else if($req->status=='disable'){
            $update =Slider::whereIn('id',explode(",",$ids))->update(array('status' =>2)); 
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }else if($req->status=='delete'){
            $update =Slider::whereIn('id',explode(",",$ids))->delete();
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }
    }
}
