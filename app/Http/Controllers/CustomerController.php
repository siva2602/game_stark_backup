<?php

namespace App\Http\Controllers;

use App\Models\MonitorLog;
use App\Models\Users;
use Illuminate\Http\Request;
use DataTables,Auth;
use DB;
use Carbon\Carbon;
class CustomerController extends Controller
{
    private $query;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('pages.users');
    }
    
    public function bannedindex()
    {
       return view('pages.ban-users');
    }

    public function getUserList($status){
          $data  = Users::query()->where('status','=',$status)->orderBy('cust_id', 'DESC');

           return Datatables::eloquent($data)
           ->addIndexColumn()
           ->addColumn('inserted_at', function($data){
                return date('d-M-Y g:i A', strtotime($data->inserted_at));
            })
            ->addColumn('profile', function($data){
                if($data->profile=="null" || $data->profile==NULL){
                    return '<a target="blank" href="'.url('img/userpro.png').'" class="rounded-circle"><img src="'.url('img/userpro.png').'" alt="user image" class="rounded-circle img-60 align-top mr-15"></a>';  
                }else if($data->type=="google"){
                    return '<a target="blank" href="'.$data->profile.'" class="rounded-circle"><img src="'.$data->profile.'" alt="user image" class="rounded-circle img-60 align-top mr-15"></a>';  
                }else{
                   return '<a target="blank" href="images/user/'.$data->profile.'" class="rounded-circle"><img src="images/user/'.$data->profile.'" alt="user image" class="rounded-circle img-60 align-top mr-15"></a>';  
                }
             })  
          ->addColumn('status', function($data){
                $status = $data->status;
                if($status ==0){
                    return '<span class="badge badge-success m-1" id="1" data-id="'.$data->cust_id.'">Active</span>
                    ';
                }else{
                    return '<span class="badge badge-danger m-1" id="0" data-id="'.$data->cust_id.'">Banned</span>';  
                }
          })
          
          ->addColumn('country', function($data){
              return '<img src="https://ipdata.co/flags/'.strtolower($data->country).'.png"/>';
          })
           ->addColumn('action', function($data){
              $status = $data->status;
                if($status ==0){
                    $type= '<button type="button" class="btn btn-danger status" id="1" data-id="'.$data->cust_id.'" ><i class="ik ik-slash"></i>Ban</button>
                    ';
                }else{
                    $type= '<button type="button" class="btn btn-success status" id="0" data-id="'.$data->cust_id.'" ><i class="ik ik-x-circle"></i>Un Ban</button>';  
                }
               
                    return '<div class="table-actions">
                            '.$type.'
                            <a href="/user/track/'.$data->cust_id.'"><button type="button" data-id="'.$data->cust_id.'" class="btn btn-dark tr"><i class="ik ik-activity"></i>Track</button></a>
                            <button type="button" class="btn btn-danger remove-user" data-id="'.$data->cust_id.'" ><i class="ik ik-trash"></i>Delete</button>
                        </div>';
        
            })
            ->rawColumns(['DT_RowIndex','profile','inserted_at','country','status','action'])
            ->toJson();
    } 
    
    public function getSearchList($name){
            
         $data = Users::where('name', 'LIKE', "%{$name}%") 
                   ->orWhere('email', 'LIKE', "%{$name}%")
                   ->orWhere('country', 'LIKE', "%{$name}%")
                   ->orWhere('refferal_id', 'LIKE', "%{$name}%")
                   ->orWhere('ip', 'LIKE', "%{$name}%");


           return Datatables::eloquent($data)
           ->addIndexColumn()
           ->addColumn('inserted_at', function($data){
            return date('d-M-Y g:i A', strtotime($data->inserted_at));
            })
             ->addColumn('profile', function($data){
                if($data->profile==null){
                    return '<a target="blank" href="'.url('img/userpro.png').'" class="rounded-circle"><img src="'.url('img/userpro.png').'" alt="user image" class="rounded-circle img-60 align-top mr-15"></a>';  
                }else{
                   return '<a target="blank" href="images/user/'.$data->profile.'" class="rounded-circle"><img src="images/user/'.$data->profile.'" alt="user image" class="rounded-circle img-60 align-top mr-15"></a>';  
                }
                }) 
         ->addColumn('status', function($data){
            $status = $data->status;
            if($status ==0){
                return '<span class="badge badge-success m-1" id="1" data-id="'.$data->cust_id.'">Active</span>
                ';
            }else{
                return '<span class="badge badge-danger m-1 " id="0" data-id="'.$data->cust_id.'">Ban</span>';  
            }
        })
                
                ->addColumn('country', function($data){
                  return '<img src="https://ipdata.co/flags/'.strtolower($data->country).'.png"/>';
              })
                ->addColumn('action', function($data){
                    $status = $data->status;
                    if($status ==0){
                        $type= '<button type="button" class="btn btn-danger status" id="1" data-id="'.$data->cust_id.'" ><i class="ik ik-slash"></i>Ban</button>
                        ';
                    }else{
                        $type= '<button type="button" class="btn btn-success status" id="0" data-id="'.$data->cust_id.'" ><i class="ik ik-x-circle"></i>Un Ban</button>';  
                    }
                        return '<div class="table-actions">
                                '.$type.'
                                <a href="/user/track/'.$data->cust_id.'" target="blank"><button type="button" data-id="'.$data->cust_id.'" class="btn btn-dark "><i class="ik ik-activity"></i>Track</button></a>
                                <button type="button" class="btn btn-info add-coin" data-id="'.$data->cust_id.'" ><i class="ik ik-plus"></i>Add Coin</button>
                                <button type="button" class="btn btn-warning send-noti" data-id="'.$data->cust_id.'" ><i class="ik ik-bell"></i>Send Notification</button>
                                <button type="button" class="btn btn-danger delete-trans" data-id="'.$data->cust_id.'" ><i class="ik ik-trash"></i>Delete All Transaction</button>
                                <button type="button" class="btn btn-danger remove-user" data-id="'.$data->cust_id.'" ><i class="ik ik-trash"></i>Delete</button>
                            </div>';
            
                })
        
                ->rawColumns(['DT_RowIndex','profile','inserted_at','country','status','action'])
                ->toJson();
    }

    public function search(Request $req){
        getSearchList($req->name);
    }
 
    public function status(Request $request)
    {
       $user = Users::find($request->id);
       $user->status=$request->status; 
       $user->reason=$request->reason; 
       $user->banned_time=Carbon::now(); 
       $res= $user->save();
            if($res){
                return redirect('/users')->with('success','Account Status Updated !');
            }else{
                return redirect('/users')->with('error','technical Error !');
            }
    }
    
    public function getUserlog($id){
          $data  = MonitorLog::query()->where('userid','=',$id)->orderBy('id', 'DESC');

           return Datatables::eloquent($data)
             ->addColumn('DT_RowIndex', function($data){
             return '<input type="checkbox" class="sub_chk" value="'.$data->id.'" data-id="'.$data->id.'">';
             })
             
             ->addColumn('remark', function($data){
             return $data->type.' Used';
             })
            ->rawColumns(['DT_RowIndex','remark'])
            ->toJson();
    } 
    
    public function add_coin(Request $request){
        $balance = Users::where('cust_id',$request->id)->get()->first()->balance;
       
       $user= Users::find($request->id);
       $user->balance=$balance+$request->coin; 
       $res= $user->save();
       
       $trns = DB::table('transaction')
                    ->insert(['tran_type'=>'credit',
                              'user_id'=>$request->id,
                              'amount'=>$request->coin,
                              'type'=>'Added by admin',
                              'remained_balance'=>$balance+$request->coin,
                              'remarks'=>$request->reason ]);
            if($trns){
                return redirect('/search-user')->with('success','Coin Added Successfully !');
            }else{
                return redirect('/search-user')->with('error','technical Error !');
            } 
    }

    public function destroy($id)
    {
          DB::table('transaction')->where('user_id','=',$id)->delete();
          Users::find($id)->delete();
          return 1;   
    }
    
    public function delUserlog($id)
    {   $ids = $req->id;
         MonitorLog::whereIn('id',explode(",",$ids))->delete(); 
            return 1;
    }
}
