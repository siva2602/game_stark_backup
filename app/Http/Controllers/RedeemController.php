<?php

namespace App\Http\Controllers;

use App\Models\Redeem;
use App\Models\RedeemCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Image;
use File;
use Illuminate\Support\Facades\Storage;
class RedeemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('redeem.redeem');
    }

    public function List(){
        $data=Redeem::query();

        return DataTables::eloquent($data)
          ->addColumn('DT_RowIndex', function($data){
             return '<input type="checkbox" class="sub_chk" value="'.$data->id.'" data-id="'.$data->id.'">';
             })
         ->addColumn('status', function($data){
             $status = $data->status;
                    if($status ==0){
                        return '<span class="badge badge-success m-1 status" id="1" data-id="'.$data->cust_id.'">Active</span>
                        ';
                    }else{
                        return '<span class="badge badge-danger m-1 status" id="0" data-id="'.$data->cust_id.'">Disable</span>';  
                    }
             })         
         ->addColumn('image',function($data){
            $image = RedeemCat::where('id',$data->category)->get()->first()->image;
             return '<img src="'.url('images/'.$image).'" alt="An image" height="100px">';
         })
         ->addColumn('action', function($data){
            return '<div class="table-actions">
                 <a href="'.url('/payment-options/edit/'.$data->id).'" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Edit</button></a>    
                 <button type="button" class="btn btn-danger remove-redeem" data-id="'.$data->id.'"  ><i class="ik ik-trash"></i>Delete</button>
              </div>';    
         })
         ->rawColumns(['DT_RowIndex','status','image','action'])      
        ->toJson();
  
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=RedeemCat::get();
        return view('redeem.create-redeem',['cat'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $img=RedeemCat::where('id',$request->category)->get()->first()->image;
        $redeem= new Redeem;
        $redeem->title=$request->name;
        $redeem->category=$request->category;
        $redeem->points=$request->coin;
        $redeem->placeholder=$request->placeholder;
        $redeem->input_type=$request->input_type;
        $redeem->image=$img;
        $res=$redeem->save();
            if($res){
                return redirect('/payment-options')->with('success', 'Task Created Successfully!');
            }else{
                return redirect('/payment-options')->with('error', 'Technical Error!');
            }
      }
  
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Redeem  $redeem
     * @return \Illuminate\Http\Response
     */
    public function edit(Redeem $id)
    {
      $data=RedeemCat::get();  
      return view('redeem.edit-redeem',['redeem'=>$id,'cat'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Redeem  $redeem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Redeem $redeem)
    {
       $img=RedeemCat::where('id',$request->category)->get()->first()->image;
        $redeem= Redeem::find($request->id);
        $redeem->title=$request->name;
        $redeem->category=$request->category;
        $redeem->points=$request->coin;
        $redeem->image=$img;
        $redeem->placeholder=$request->placeholder;
        $redeem->input_type=$request->input_type;
        $res=$redeem->save();
            if($res){
                return redirect('/payment-options')->with('success', 'Update Successfully!');
            }else{
                return redirect('/payment-options')->with('error', 'Technical Error!');
            }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Redeem  $redeem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Redeem::find($id)->delete();
        return 1;
    }
    
    public function action(Request $req)
    {
        $ids = $req->id;
        if($req->status=='enable'){
           $update =Redeem::whereIn('id',explode(",",$ids))->update(array('status' =>0)); 
            if($update){
                return 1;
            }else{
                return "not updated";
            }
        }
        else if($req->status=='disable'){
            $update =Redeem::whereIn('id',explode(",",$ids))->update(array('status' =>2)); 
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }
        else if($req->status=='delete'){
            Redeem::whereIn('id',explode(",",$ids))->delete(); 
            return 1;
        }
    }
}
