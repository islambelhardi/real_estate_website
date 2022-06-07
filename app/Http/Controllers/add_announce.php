<?php

namespace App\Http\Controllers;

use App\Models\announce;
use App\Models\image;
use Illuminate\Http\Request;

class add_announce extends Controller
{
    //
    function index(){
        return view('Add_Announce_Page');
    }

    public function store(Request $request)
    {
        $announce = new announce;
        $announce->propretytype = $request->propretytype;
        $announce->title = $request->title;
        $announce->roomnumber = $request->roomnumber;
        $announce->surface = $request->surface;
        $announce->price = $request->price;
        //$announce->place = $request->place;
        $announce->description = $request->description;
        $announce->save();
        if($request->file('photos')){
            foreach ($request->file('photos') as $requestimage){
                $filename= date('YmdHi').$requestimage->getClientOriginalName();
                $requestimage-> move(public_path('public/AnnouncesImages'), $filename);
                $image= new image();
                $image->url='public/AnnouncesImages/'.$filename;
                $image->announce_id=$announce->id;
                $announce->img= $filename;
                $announce->save();
                $image->save();
            }

        }

        return redirect('/')->with('status', 'Blog Post Form Data Has Been inserted');
    }
}
