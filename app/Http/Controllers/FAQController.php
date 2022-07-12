<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.faq');
    }

    public function List(){
        $data=FAQ::get();

       return DataTables::of($data)
         ->addColumn('DT_RowIndex', function($data){
             return '<input type="checkbox" class="sub_chk" value="'.$data->id.'" data-id="'.$data->id.'">';
             })

        ->addColumn('action', function($data){
            return '<div class="table-actions">
                <button type="button" class="btn btn-success edit-faq"  data-id="'.$data->id.'" ><i class="ik ik-edit"></i>Edit</button>';     
        })    
        ->rawColumns(['DT_RowIndex','action'])      
        ->make(true);    
    }



    public function store(Request $request)
    {
       $faq= new FAQ;
       $faq->question=$request->question;
       $faq->answer=$request->answer;
       $faq->type=$request->type;
       $res=$faq->save();

            if($res){
                return redirect ('/faq')->with('success','Data Added Successfully');
            }else{
                return redirect ('/faq')->with('error','Technical Error!');
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
  public function edit(FAQ $id)
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
  public function update(Request $request,FAQ $fAQ)
    {
       $fAQ= FAQ::find($request->id);
       $fAQ->question=$request->question;
       $fAQ->answer=$request->answer;
       $fAQ->type=$request->type;
       $res=$fAQ->save();

            if($res){
                return redirect ('/faq')->with('success','Update Successfully');
            }else{
                return redirect ('/faq')->with('error','Technical Error!');
            } 
    }

     public function action(Request $req)
    {
        $ids = $req->id;
        if($req->status=='enable'){
           $update =FAQ::whereIn('id',explode(",",$ids))->update(array('status' =>0)); 
            if($update){
                return 1;
            }else{
                return "not updated";
            }
        }
        else if($req->status=='disable'){
            $update =FAQ::whereIn('id',explode(",",$ids))->update(array('status' =>2)); 
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }
        else if($req->status=='delete'){
            FAQ::whereIn('id',explode(",",$ids))->delete(); 
            return 1;
        }
    }
}
