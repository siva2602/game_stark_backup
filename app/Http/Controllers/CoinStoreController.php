<?php

namespace App\Http\Controllers;

use App\Models\CoinStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class CoinStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.coin');
    }

    public function List(){
        $data=CoinStore::get();

       return DataTables::of($data)
         ->addColumn('DT_RowIndex', function($data){
             return '<input type="checkbox" class="sub_chk" value="'.$data->id.'" data-id="'.$data->id.'">';
             })
             
        ->addColumn('amount', function($data){
             return  $data->currency.' '.$data->amount;
             })
        ->editColumn('status', function($data){
             $status = $data->status;
                    if($status ==0){
                        return '<span class="badge badge-success m-1 " id="1" >Active</span>
                        ';
                    }else{
                        return '<span class="badge badge-danger m-1 " id="0" >Disable</span>';  
                    }
             })   
        ->addColumn('action', function($data){
            return '<div class="table-actions">
                <button type="button" class="btn btn-success edit-coinstore"  data-id="'.$data->id.'" ><i class="ik ik-edit"></i>Edit</button>';     
        })    
        ->rawColumns(['DT_RowIndex','status','action'])      
        ->make(true);    
    }



    public function store(Request $request)
    {
       $cs= new CoinStore;
       $cs->country=$request->country;
       $cs->title=$request->package;
       $cs->amount=$request->amount;
       $cs->currency=$request->currency;
       $cs->coin=$request->coin;
       $res=$cs->save();

            if($res){
                return redirect ('/coinstore')->with('success','Added Successfully');
            }else{
                return redirect ('/coinstore')->with('error','Technical Error!');
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
  public function edit(CoinStore $id)
    {
       return $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
  public function update(Request $request,CoinStore $cs)
    {
       $cs= CoinStore::find($request->id);
       $cs->country=$request->country;
       $cs->title=$request->package;
       $cs->currency=$request->currency;
       $cs->amount=$request->amount;
       $cs->coin=$request->coin;
       $res=$cs->save();

            if($res){
                return redirect ('/coinstore')->with('success','Update Successfully');
            }else{
                return redirect ('/coinstore')->with('error','Technical Error!');
            } 
    }

     public function action(Request $req)
    {
        $ids = $req->id;
        if($req->status=='enable'){
           $update =CoinStore::whereIn('id',explode(",",$ids))->update(array('status' =>0)); 
            if($update){
                return 1;
            }else{
                return "not updated";
            }
        }
        else if($req->status=='disable'){
            $update =CoinStore::whereIn('id',explode(",",$ids))->update(array('status' =>2)); 
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }
        else if($req->status=='delete'){
            CoinStore::whereIn('id',explode(",",$ids))->delete(); 
            return 1;
        }
    }
}
