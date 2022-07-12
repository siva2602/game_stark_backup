<?php

namespace App\Http\Controllers;

use App\Models\MonitorLog;
use App\Models\Transaction;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('transaction');
    }

    public function getTransacitonList(){
      $data = DB::table('transaction')
      ->join('customer', 'customer.cust_id', '=', 'transaction.user_id')
      ->select('transaction.*', 'customer.name')
      ->orderBy('transaction.id','DESC');
      
      return Datatables::queryBuilder($data)
      ->addIndexColumn()
      ->addColumn('inserted_at', function($data){
             return date('d-M-Y g:i A', strtotime($data->inserted_at));
 
        })
        ->addColumn('tran_type', function($data){
            if($data->tran_type == 'credit'){
                return '<span class="badge badge-success m-1">Credit</span>';
            }else{
                return '<span class="badge badge-danger m-1">Debit</span>';  
            }
        })
         ->addColumn('action', function($data){
            return '<div class="table-actions">
                    <a href="/user/track/'.$data->user_id.'" target="blank"><button type="button" data-id="'.$data->user_id.'" class="btn btn-dark "><i class="ik ik-activity"></i>Track</button></a>
                    <button type="button" class="btn btn-danger remove-user" data-id="'.$data->user_id.'" ><i class="ik ik-trash"></i>Delete User</button>
                </div>';
        
            })
        ->rawColumns(['DT_RowIndex','inserted_at','action','tran_type'])
        ->toJson();
}

public function getPayTransacitonList(){
      $data = DB::table('payment_transaction')
      ->orderBy('id','DESC');
      
      return Datatables::queryBuilder($data)
      ->addIndexColumn()
      ->addColumn('userid',function($data){
          $user=DB::table('customer')->where('cust_id','=',$data->userid)->get();
          return 'Name :'.$user[0]->name.'<br> Email : '.$user[0]->email;
      })
      ->addColumn('created_at', function($data){
             return date('d-M-Y g:i A', strtotime($data->created_at));
 
        })  
         ->addColumn('action', function($data){
            return '<div class="table-actions">
                    <a href="/user/track/'.$data->userid.'" target="blank"><button type="button" data-id="'.$data->userid.'" class="btn btn-dark "><i class="ik ik-activity"></i>User Info</button></a>
                    <button type="button" class="btn btn-danger remove-tranns" data-id="'.$data->id.'" ><i class="ik ik-trash"></i>Delete</button>
                </div>';
        
            })
        ->rawColumns(['DT_RowIndex','created_at','userid','action'])
        ->toJson();
}

    public function transactionbydate(Request $req){
       $data = DB::table('transaction')
      ->join('customer', 'customer.cust_id', '=', 'transaction.user_id')
      ->select('transaction.*', 'customer.name')
      ->whereBetween('transaction.inserted_at',[$req->startdate,$req->enddate])
      //->where('transaction.inserted_at','>=',)
      ->orderBy('transaction.id','DESC');
      
       return Datatables::queryBuilder($data)
      ->addIndexColumn()
      ->addColumn('inserted_at', function($data){
             return date('d-M-Y g:i A', strtotime($data->inserted_at));
 
        })
        ->addColumn('tran_type', function($data){
            if($data->tran_type == 'credit'){
                return '<span class="badge badge-success m-1">Credit</span>';
            }else{
                return '<span class="badge badge-danger m-1">Debit</span>';  
            }
        })
         ->addColumn('action', function($data){
            return '<div class="table-actions">
                    <a href="/user/track/'.$data->user_id.'" target="blank"><button type="button" data-id="'.$data->user_id.'" class="btn btn-dark "><i class="ik ik-activity"></i>Track</button></a>
                    <button type="button" class="btn btn-danger remove-user" data-id="'.$data->user_id.'" ><i class="ik ik-trash"></i>Delete User</button>
                </div>';
        
            })
        ->rawColumns(['DT_RowIndex','inserted_at','action','tran_type'])
        ->toJson();
    }


    public function getUserTransaciton($id){
      $data = DB::table('transaction')
      ->join('customer', 'customer.cust_id', '=', 'transaction.user_id')
      ->select('transaction.*', 'customer.name')
      ->where('transaction.user_id','=',$id)
      ->orderBy('transaction.id','DESC');
      
      return Datatables::queryBuilder($data)
        ->addColumn('DT_RowIndex', function($data){
             return '<input type="checkbox" class="sub_chk" value="'.$data->id.'" data-id="'.$data->id.'">';
             })
        ->addColumn('inserted_at', function($data){
             return date('d-M-Y g:i A', strtotime($data->inserted_at));
 
        })
        ->addColumn('tran_type', function($data){
            if($data->tran_type == 'credit'){
                return '<span class="badge badge-success m-1">Credit</span>';
            }else{
                return '<span class="badge badge-danger m-1">Debit</span>';  
            }
        })
        ->rawColumns(['DT_RowIndex','inserted_at','tran_type'])
        ->toJson();

}

    public function trackView(Users $id){
        
        return view('pages.track',['user'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function deleteTransaciton($id)
    {
       DB::table('transaction')->where(['user_id'=>$id,'api_type'=>null])->delete();
       return 1;
    }
    
    public function deletePayTransaciton($id)
    {
       DB::table('payment_transaction')->where('id',$id)->delete();
       return 1;
    }
    
    
    public function action(Request $req)
    {
        $ids = $req->id;
         if($req->status=='delete'){
            DB::table('transaction')->whereIn('id',explode(",",$ids))->delete(); 
            return 1;
        }
    }

}
