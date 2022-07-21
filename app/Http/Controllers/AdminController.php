<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Models\Users;
use App\Models\ActiveUser;
use App\Models\Video;
use App\Models\Weblink;
use App\Models\Redeem;
use App\Models\Apps;
use DataTables,Auth;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        \Artisan::call('view:clear');
        \Artisan::call('cache:clear');
        \Artisan::call('route:clear');
        \Artisan::call('config:clear');
        $user=  Users::count();   
        $apps=  Apps::count();   
        $redeem=  Redeem::count();   
        $video=  Video::count();   
        $weblink=  Weblink::count();   
        $pending=DB::table('recharge_request')->where('status','Pending')->count();
        $complete=DB::table('recharge_request')->where('status','Success')->count();
        $trans=DB::table('transaction')->count();
        $paytrans=DB::table('payment_transaction')->orderBy('id','DESC')->get()->take(5);
        $topuser=DB::table('customer')->orderBy('balance','DESC')->get()->take(5);
        
            
        $allusercount = Users::select('cust_id','inserted_at')
            ->get()
            ->groupBy(function ($datess) {
                if(Carbon::parse($datess->inserted_at)->format('Y')==Carbon::now()->year){
                                return Carbon::parse($datess->inserted_at)->format('m');
                }
            });

            $usermcountss = [];
            $userArrss = [];
        
            foreach ($allusercount as $key => $value) {
                $usermcountss[(int)$key] = count($value);
            }
        
            $monthss = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        
            for ($i = 1; $i <= 12; $i++) {
                if (!empty($usermcountss[$i])) {
                    $userArrss[$i]['count'] = $usermcountss[$i];
                } else {
                    $userArrss[$i]['count'] = 0;
                }
                $userArrss[$i]['month'] = $monthss[$i - 1];
            }       
        
           $today= ActiveUser::whereDate('created_at', Carbon::today())->get()->count();
           $week = ActiveUser::where('created_at', '>', Carbon::now()->startOfWeek())->where('created_at', '<', Carbon::now()->endOfWeek())->get()->count();
           $last = ActiveUser::where('last_used_at', '>=',Carbon::now()->subMinutes(30)->toDateTimeString())->get()->count();
             
           $month=  ActiveUser::whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'))
                    ->get(['name','created_at'])
                    ->count();
                    
            return view('pages.dashboard',
                ['user'=>$user,
                'apps'=>$apps,
                'redeem'=>$redeem,
                'video'=>$video,
                'weblink'=>$weblink,
                'pending'=>$pending,
                'alluser'=>$userArrss,
                'month'=>$month,
                'week'=>$week,
                'today'=>$today,
                'trans'=>$trans,
                'last'=>$last,
                'paytrans'=>$paytrans,
                'complete'=>$complete,
                'topuser'=>$topuser]);
    }

   
    public function admin(){
        $data= User::find(2);
        return view('pages.admin',['data'=>$data]);
    }
    
    public function update(Request $req){
        $admin = User::find(2);
              
         if (!$admin || !Hash::check($req->oldpass,$admin->password)) {
            return redirect ('/admin-profile')->with('error','Old Password Not Matched !!');    
        }else{
            if($req->newpas == $req->cnpas){
                $admin = User::find(2);
                $admin->email=$req->email;
                $admin->password=Hash::make($req->newpas);
                $res=$admin->save();
                    if($res){
                        return redirect ('/admin-profile')->with('success','Update Successfully !!');    
                    }else{
                        return redirect ('/admin-profile')->with('error','Error While Update Data !!');      
                    }    
            }else{
                return redirect ('/admin-profile')->with('error','New Password and Confirm Password Not Matched !!');       
            }    
        }
    }

    public function verify(Request $req)
    {
        $licence = base64_encode($req->licence);
        $package= base64_encode($req->package);
        
        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,base64_decode('aHR0cHM6Ly9saWNlbmNlLnRlY2huaWNhbHN1bWVyLmNvbS9nZXRkYXRhbmFtZS5waHA/Y3BuPQ==').$req->licence);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $query = curl_exec($curl_handle);
        $data = json_decode($query, true);
        curl_close($curl_handle);
        
        $pac= $data["lists"][0]["package"];
        $lice= $data["lists"][0]["purchase_code"];
            
            if($pac==$req->package && $lice==$req->licence){
                $admin = User::find(2);
                $admin->licence=$licence;
                $admin->package=$package;
                $res=$admin->save();
                    if($res){
                        return redirect ('/admin-profile')->with('success','Licence Verified Successfully !!');    
                    }else{
                        return redirect ('/admin-profile')->with('error','Error While Update Data !!');      
                    }   
            }else{
                return redirect ('/admin-profile')->with('error','Licence Details Not Found!!');         
            }
        }


    }