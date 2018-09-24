<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categori;
use App\Slide;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['cat']=Categori::where('pub','=','0')->get()->pluck('name','id');      
        $data['posts']=Post::where('pub','=','0')->get();
        $data['slide']=Slide::where('pub','=','0')->get();

     return view('libro.postlist',compact('data'));
    }
       public function showPost($postid)
    {
        $data=Post::findOrFalse($postid)->get() ;
     //   print_r($data['cat']);
        return view('libro.index',compact('data'));
    }
}
