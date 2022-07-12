<?php

namespace App\Http\Controllers;

use App\Models\RedeemCat;
use App\Models\Redeem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Image;
use File;
use Illuminate\Support\Facades\Storage;

class RedeemCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('redeem.redeemcat');
    }

  public function List(){
        $data=RedeemCat::query();

        return DataTables::eloquent($data)
          ->addIndexColumn()
         ->addColumn('status', function($data){
             $status = $data->status;
                    if($status ==0){
                        return '<span class="badge badge-success m-1 status" id="1" data-id="'.$data->cust_id.'">Enabled</span>
                        ';
                    }else{
                        return '<span class="badge badge-danger m-1 status" id="0" data-id="'.$data->cust_id.'">Disabled</span>';  
                    }
             })         
         ->addColumn('image',function($data){
             return '<img src="'.url('images/'.$data->image).'" alt="An image" height="100px">';
         })
         ->addColumn('action', function($data){
            return '<div class="table-actions">
                 <a href="'.url('/reward-cat/edit/'.$data->id).'" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Edit</button></a>    
                 <button type="button" class="btn btn-danger remove-redeemcat" data-id="'.$data->id.'"  ><i class="ik ik-trash"></i>Delete</button>
              </div>';    
         })
         ->rawColumns(['DT_RowIndex','status','image','action'])      
         ->toJson();
 
    }
    
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
        $image_resize->resize(200,200);
        $save= $image_resize->save('images/'.$fileNameToStore);

        if($save){
            $redeemcat= new RedeemCat;
            $redeemcat->name=$request->name;
            $redeemcat->image=$fileNameToStore;
            $res=$redeemcat->save();
                if($res){
                    return redirect('/reward-cat')->with('success', 'Task Created Successfully!');
                }else{
                    return redirect('/reward-cat')->with('error', 'Technical Error!');
                }
        }else{
            return redirect('/reward-cat')->with('error', 'Technical Error Image!');
        } 
      }


    public function edit(RedeemCat $id)
    {
      return view('redeem.edit-redeemcat',['redeem'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RedeemCat  $redeemCat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RedeemCat $redeemcat)
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
        
        $redeemcat= RedeemCat::find($request->id);
        $redeemcat->name=$request->name;
        $redeemcat->image=$icon;
        $res=$redeemcat->save();
            if($res){
                Redeem::where('category','=',$request->id)->update(['image'=>$icon]);
                return redirect('/reward-cat')->with('success', 'Update Successfully!');
            }else{
                return redirect('/reward-cat')->with('error', 'Technical Error!');
            }  
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RedeemCat  $redeemCat
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
         $imagePath = public_path('images/'.RedeemCat::find($id)->get()->first()->image);
            if(File::exists($imagePath)){
                unlink($imagePath);
            }
        RedeemCat::find($id)->delete();
        Redeem::where('category','=',$id)->delete();
        return 1;
    }
    
    public function action(Request $req)
    {
        $ids = $req->id;
        if($req->status=='enable'){
           $update =RedeemCat::whereIn('id',explode(",",$ids))->update(array('status' =>0)); 
            if($update){
                return 1;
            }else{
                return "not updated";
            }
        }
        else if($req->status=='disable'){
            $update =RedeemCat::whereIn('id',explode(",",$ids))->update(array('status' =>2)); 
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }
    }
}
