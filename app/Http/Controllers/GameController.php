<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables,Validator;
use Image;
use Illuminate\Support\Facades\Storage;
use File;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('game.game');
    }

     public function List(){
        $data=Game::query();

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
             return '<img src="'.url('images/games/'.$data->image).'" alt="An image" height="100px">';
         })
         ->addColumn('action', function($data){
            return '<div class="table-actions">
                 <a href="'.url('/game/edit/'.$data->id).'" ><button type="button" class="btn btn-success" ><i class="ik ik-edit"></i>Edit</button></a>    
                 <button type="button" class="btn btn-danger remove-game" data-id="'.$data->id.'"  ><i class="ik ik-trash"></i>Delete</button>
              </div>';    
         })
         ->rawColumns(['DT_RowIndex','status','image','action'])      
          ->toJson();
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
        $image_resize->resize(300,200);
        $save= $image_resize->save('images/games/'.$fileNameToStore);

        if($save){
            $game= new Game;
            $game->title=$request->title;
            $game->image=$fileNameToStore;
            $game->link=$request->link;
            $res=$game->save();
                if($res){
                    return redirect('/game')->with('success', 'Task Created Successfully!');
                }else{
                    return redirect('/game')->with('error', 'Technical Error!');
                }
        }else{
            return redirect('/game')->with('error', 'Technical Error Image!');
        } 
      }

 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
  public function edit(Game $id)
    {
      return view('game.edit-game',['game'=>$id]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
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
            $image_resize->resize(300,200);
            $save= $image_resize->save('images/games/'.$fileNameToStore);
            $icon=$fileNameToStore;
            $imagePath = public_path('images/games/'.$request->oldimage);
            if(File::exists($imagePath)){
               unlink($imagePath);
            }
        }
        else
        {
         $icon=$request->oldimage; 
        }
        
        $game= Game::find($request->id);
        $game->title=$request->title;
        $game->image=$fileNameToStore;
        $game->link=$request->link;
        $res=$game->save();
            if($res){
                return redirect('/game')->with('success', 'Update Successfully!');
            }else{
                return redirect('/game')->with('error', 'Technical Error!');
            }  
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        Game::find($id)->delete();
        return 1;
    }
    
    public function action(Request $req)
    {
        $ids = $req->id;
        if($req->status=='enable'){
           $update =Game::whereIn('id',explode(",",$ids))->update(array('status' =>0)); 
            if($update){
                return 1;
            }else{
                return "not updated";
            }
        }
        else if($req->status=='disable'){
            $update =Game::whereIn('id',explode(",",$ids))->update(array('status' =>2)); 
            if($update){
                return 1;
            }else{
                return "not updated".$ids;
            }
        }
        else if($req->status=='delete'){
            Game::whereIn('id',explode(",",$ids))->delete(); 
            return 1;
        }
    }
}
