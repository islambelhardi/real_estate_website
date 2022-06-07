<?php

namespace App\Http\Controllers;

use App\Models\announce;
use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class announce_details extends Controller
{
    //
    function index(){

        $data = announce::all();

        return view('Home_Page',['announces'=>$data]);
    }
    function addcomment(Request $request){
        $comment= new comment;
        $user_name=Auth::user()->name;
        $comment->announce_id=$request->id;
        $comment->user_name=$user_name;
        $comment->content=$request->comment;
        $comment->save();
        return $this->details($request->id);

    }
    function details($id){
        $announce =announce::Where('id',$id)->first();
        $comments=$announce->comments;
        return view('announce_page',['announce'=>$announce,'comments'=>$comments]);
    }
}
