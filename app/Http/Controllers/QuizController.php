<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Image;
use Illuminate\Support\Facades\Storage;
use File;
class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('quiz.quiz');
    
    }
    
    public function cat_index()
    {
       return view('quiz.quiz-cat');
    }


    public function List(){
        $data=Quiz::query();

        return DataTables::eloquent($data)
          ->addColumn('DT_RowIndex', function($data){
             return '<input type="checkbox" class="sub_chk" value="'.$data->id.'" data-id="'.$data->id.'">';
             })
          ->addColumn('status', function($data){
             $status = $data->status;
                    if($status ==0){
                        return '<span class="badge badge-warning m-1 status" id="1" data-id="'.$data->cust_id.'">Active</span>
                        ';
                    }else{
                        return '<span class="badge badge-danger m-1 status" id="0" data-id="'.$data->cust_id.'">Disable</span>';  
                    }
             })         
         ->addColumn('link',function($data){
             return '<a href="'.$data->link.'" target="blank">"'.$data->link.'"</a>';
         })

         ->addColumn('action', function($data){
            return '<div class="table-actions">
                 <a href="'.url('/quiz/edit/'.$data->id).'" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Edit</button></a>    
                 <button type="button" class="btn btn-danger remove-quiz" data-id="'.$data->id.'"  ><i class="ik ik-trash"></i>Delete</button>
              </div>';    
         })
         ->rawColumns(['DT_RowIndex','status','link','action'])      
          ->toJson();
  
    }
    
    public function cat_List(){
        $data=DB::table('quiz_cat')->orderBy('id','DESC');

        return DataTables::queryBuilder($data)
          ->addColumn('DT_RowIndex', function($data){
             return '<input type="checkbox" class="sub_chk" value="'.$data->id.'" data-id="'.$data->id.'">';
             })
          ->addColumn('status', function($data){
             $status = $data->status;
                    if($status ==0){
                        return '<span class="badge badge-warning m-1" id="1" data-id="'.$data->id.'">Active</span>
                        ';
                    }else{
                        return '<span class="badge badge-danger m-1" id="0" data-id="'.$data->id.'">Disable</span>';  
                    }
             })         
         ->addColumn('icon',function($data){
             return '<img src="'.url('images/'.$data->icon).'" alt="An image" height="100px">';
         })
         ->addColumn('action', function($data){
            return '<div class="table-actions">
                 <button type="button" class="btn btn-success edit-quizcat" data-id="'.$data->id.'"  ><i class="ik ik-edit"></i>Edit</button>
                 <button type="button" class="btn btn-danger remove-quizcat" data-id="'.$data->id.'"  ><i class="ik ik-trash"></i>Delete</button>
              </div>';    
         })
         ->rawColumns(['DT_RowIndex','status','icon','action'])      
          ->toJson();
  
    }
    
    public function create(){
        return view('quiz.create-quiz',['cat'=>DB::table('quiz_cat')->get()]);
    }
    
    public function store(Request $request)
    {
            $quiz= new Quiz;
            $quiz->question=$request->question;
            $quiz->category=$request->category;
            $quiz->a=$request->a;
            $quiz->b=$request->b;
            $quiz->c=$request->c;
            $quiz->d=$request->d;
            $quiz->answer=$request->answer;
            $quiz->coin=$request->coin;
            $res=$quiz->save();
                if($res){
                    return redirect('/quiz')->with('success', 'Task Created Successfully!');
                }else{
                    return redirect('/quiz')->with('error', 'Technical Error!');
                }
     } 
      
      
    public function cat_store(Request $request)
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
          $res=  DB::table('quiz_cat')->insert([
                'icon'=>$fileNameToStore,
                'title'=>$request->title,
                'description'=>$request->description
                ]);
                
            if($res){
                return redirect('/quiz-cat')->with('success', ' Created Successfully!');
            }else{
                return redirect('/quiz-cat')->with('error', 'Technical Error!');
            }
        }else{
            return redirect('/quiz')->with('error', 'Technical Error Image!');
        } 
      }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $id)
    {
       return view('quiz.edit-quiz',['quiz'=>$id,'cat'=>DB::table('quiz_cat')->get()]);
    }
    
    public function cat_edit($id)
    {
       $data= DB::table('quiz_cat')->where('id',$id)->get();
        return $data=[
            'title'=>$data[0]->title,
            'description'=>$data[0]->description,
            'id'=>$data[0]->id,
            'icon'=>$data[0]->icon
            ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        
        $quiz= Quiz::find($request->id);
        $quiz->category=$request->category;
        $quiz->a=$request->a;
        $quiz->b=$request->b;
        $quiz->c=$request->c;
        $quiz->d=$request->d;
        $quiz->answer=$request->answer;
        $quiz->coin=$request->coin;
        $res=$quiz->save();
            if($res){
                return redirect('/quiz')->with('success', 'Update Successfully!');
            }else{
                return redirect('/quiz')->with('error', 'Technical Error!');
            }  
 
    }
    
    
    public function cat_update(Request $request)
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
            $imagePath = public_path('images/'.$request->oldicon);
              if(File::exists($imagePath)){
                     unlink($imagePath);
                }
        }
        else
        {
         $icon=$request->oldicon; 
        }
        
         $res=  DB::table('quiz_cat')->where('id','=',$request->ids)->update([
                'icon'=>$icon,
                'title'=>$request->title,
                'description'=>$request->description
                ]);
            if($res){
                return redirect('/quiz-cat')->with('success', 'Update Successfully!');
            }else{
                return redirect('/quiz-cat')->with('error', 'Technical Error!');
            }  
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Quiz::find($id)->delete();
        return 1;
    }
    
    public function cat_destroy($id)
    {
        
        $imagePath = public_path('images/quiz/'.DB::table('quiz_cat')->where('id',$id)->get()->first()->icon);
            if(File::exists($imagePath)){
                unlink($imagePath);
            }
        DB::table('quiz_cat')->where('id',$id)->delete();
        return 1;
    }
    
    public function action(Request $req)
    {
        $ids = $req->id;
        if($req->status=='enable'){
           $update =Quiz::whereIn('id',explode(",",$ids))->update(array('status' =>0)); 
            if($update){
                return 1;
            }else{
                return "not updated";
            }
        }
        else if($req->status=='disable'){
            $update =Quiz::whereIn('id',explode(",",$ids))->update(array('status' =>2)); 
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }
        else if($req->status=='delete'){
            Quiz::whereIn('id',explode(",",$ids))->delete(); 
            return 1;
        }
    }
    
    
    
    public function cat_action(Request $req)
    {
        $ids = $req->id;
        if($req->status=='enable'){
           $update =DB::table('quiz_cat')->whereIn('id',explode(",",$ids))->update(array('status' =>0)); 
            if($update){
                return 1;
            }else{
                return "not updated";
            }
        }
        else if($req->status=='disable'){
            $update =DB::table('quiz_cat')->whereIn('id',explode(",",$ids))->update(array('status' =>2)); 
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }
        else if($req->status=='delete'){
            DB::table('quiz_cat')->whereIn('id',explode(",",$ids))->delete(); 
            return 1;
        }
    }
}
