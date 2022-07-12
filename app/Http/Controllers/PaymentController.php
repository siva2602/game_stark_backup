<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Alert;
use App\Models\Users;
use OneSignal;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('request.request-pending');
    }

    public function pendinglist(){
        $data = DB::table('recharge_request')
      ->join('customer', 'customer.cust_id', '=', 'recharge_request.user_id')
      ->select('recharge_request.*', 'customer.name')
      ->where('recharge_request.status','=','Pending')
      ->orderBy('recharge_request.request_id','DESC');
      
      return Datatables::queryBuilder($data)
      ->addIndexColumn()
      ->addColumn('date', function($data){
             return date('d-M-Y g:i A', strtotime($data->date));
        })
        ->addColumn('amount', function($data){
          return '<p style="color:red;">'.$data->amount.'</p>';
        })
        ->addColumn('action', function($data){
            return '<div class="table-actions">
                <a href="/user/track/'.$data->user_id.'"><button type="button" class="btn btn-dark tr"><i class="ik ik-activity"></i>Track</button></a>
            <button type="button" class="btn btn-success rewa"  id="'.$data->request_id.'" data-id="'.$data->request_id.'" ><i class="ik ik-edit"></i>Update</button>
            <button type="button" class="btn btn-danger remove-paymentreq" data-id="'.$data->request_id.'"><i class="ik ik-trash"></i>Delete</button>
         </div>';
          })
          ->rawColumns(['DT_RowIndex','date','amount','action'])
        ->toJson();

    }

    public function list($id){
        $data = DB::table('recharge_request')
      ->join('customer', 'customer.cust_id', '=', 'recharge_request.user_id')
      ->select('recharge_request.*', 'customer.name')
      ->where('recharge_request.user_id', '=',$id)
      ->orderBy('recharge_request.request_id','DESC');
      
      return Datatables::queryBuilder($data)
      ->addColumn('DT_RowIndex', function($data){
             return '<input type="checkbox" class="sub_chk" value="'.$data->request_id.'" data-id="'.$data->request_id.'">';
             })
      ->addColumn('date', function($data){
             return date('d-M-Y g:i A', strtotime($data->date));
        })
        ->addColumn('amount', function($data){
          return '<p style="color:red;">'.$data->amount.'</p>';
        })
        ->addColumn('action', function($data){
            return '<div class="table-actions">
            <button type="button" class="btn btn-success rewa" ><i class="ik ik-edit"></i>Update</button>
            <button type="button" class="btn btn-danger remove-paymentreq" data-id="'.$data->request_id.'"><i class="ik ik-trash"></i>Delete</button>
         </div>';
          })
        ->rawColumns(['DT_RowIndex','date','amount','action'])
        ->toJson();

    }


    public function viewcomplete(){
        return view('request.request-complete');
    }

    public function completelist(){
      $data = DB::table('recharge_request')
      ->join('customer', 'customer.cust_id', '=', 'recharge_request.user_id')
      ->select('recharge_request.*', 'customer.name')
      ->where('recharge_request.status', '=', 'Success')
      ->orderBy('recharge_request.request_id','DESC');
      
      return Datatables::queryBuilder($data)
      ->addColumn('DT_RowIndex', function($data){
             return '<input type="checkbox" class="sub_chk" value="'.$data->request_id.'" data-id="'.$data->request_id.'">';
             })
      ->addColumn('date', function($data){
             return date('d-M-Y g:i A', strtotime($data->date));
        })
        ->addColumn('amount', function($data){
          return '<p style="color:red;">'.$data->amount.'</p>';
        })
        ->rawColumns(['DT_RowIndex','date','amount'])
        ->toJson();
    }

    public function viewreject(){
        return view('request.request-reject');
    }

    public function rejectlist(){
        $data = DB::table('recharge_request')
      ->join('customer', 'customer.cust_id', '=', 'recharge_request.user_id')
      ->select('recharge_request.*', 'customer.name')
      ->where('recharge_request.status', '=', 'Reject')
      ->orderBy('recharge_request.request_id','DESC');
      
      return Datatables::queryBuilder($data)
       ->addColumn('DT_RowIndex', function($data){
             return '<input type="checkbox" class="sub_chk" value="'.$data->request_id.'" data-id="'.$data->request_id.'">';
             })
      ->addColumn('date', function($data){
             return date('d-M-Y g:i A', strtotime($data->date));
        })
        ->addColumn('remarks', function($data){
            return '<p style="width:200px;"'.$data->remarks.'</p>';
        })
        ->addColumn('amount', function($data){
          return '<p style="color:red;">'.$data->amount.'</p>';
        })
        ->rawColumns(['DT_RowIndex','date','amount','remarks'])
       ->toJson();
    }


    public function update(Request $request)
    {
         $data=  DB::table('recharge_request')->where('request_id',$request->id)->get();
         $user=  DB::table('customer')->where('cust_id',$data[0]->user_id)->get()->first()->balance;   
        if($request->type=='Success'){
            $payment =Payment::find($request->id);
            $payment->status=$request->type;   
            $payment->remarks=$request->reason;
                $res=$payment->save();
                if($res){
                    $trns = DB::table('transaction')
                    ->insert(['tran_type'=>'debit',
                                'user_id'=>$data[0]->user_id,
                                'amount'=>$data[0]->amount,
                                'remained_balance'=>$user,
                                'remarks'=>$request->reason ]);
                        if($trns){
                            PaymentController::notifyUser("Success",$data[0]->user_id,$request->reason);
                            return redirect('/request-pending')->with('success','Update Succcessfully');
                        }else{
                            return redirect('/request-pending')->with('error','request not updated');
                        }    
                }else{
                    return redirect('/request-pending')->with('error','technical error');
                }       

        }else if($request->type=='Reject'){
            $payment =Payment::find($request->id);
            $payment->status=$request->type;   
            $payment->remarks=$request->reason;
                $res=$payment->save();
                if($res){
                    $trns = DB::table('transaction')
                    ->insert(['tran_type'=>'credit',
                                'user_id'=>$data[0]->user_id,
                                'amount'=>$data[0]->amount,
                                'remained_balance'=>$user,
                                'remarks'=>$request->reason ]);
                        if($trns){
                            $total=$user+$data[0]->amount;
                            $update=Users::find($data[0]->user_id);
                            $update->balance=$total;
                            $update->save();
                            PaymentController::notifyUser("Reject",$data[0]->user_id,$request->reason);
                            
                            return redirect('/request-pending')->with('success','Update Succcessfully');
                        }else{
                            return redirect('/request-pending')->with('error','request not updated');
                        }    
                }else{
                    return redirect('/request-pending')->with('error','technical error');
                }       
        }
    }
    
     public function notifyUser($type,$id,$reason){
        $token=Users::find($id);
        $userId=$token->p_token;
        $name=$token->name;
     
        if($type=="Reject"){
           $title= $name." Your Redeem Request has been Rejected";
            $message =$reason; 
            
        }else if($type=="Success"){
           $title=$name." Your Redeem Request has been Approved";
            $message =$reason; 
        }
        
    if($userId){
      $res=  OneSignal::sendNotificationToUser(
            $message,
            $userId,
            $url = null,
            $data = null,
            $buttons = null,
            $schedule = null,
            $headings = $title, 
            $subtitle = null
        );  
    }
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Payment::find($id)->delete();
        return 1;
    }
    
    public function action(Request $req)
    {
        $ids = $req->id;
        if($req->status=='delete'){
            $update =Payment::whereIn('request_id',explode(",",$ids))->delete();
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }
    }

}
