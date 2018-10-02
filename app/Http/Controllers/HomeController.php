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
     //   $data['slide']=Post::where([['pub','=','0'],['slide','=','0']])->get();
     $data['slide']=Post::where('slide','=','0')->get();
     return view(config('moconf.tmpl').'.postlist',compact('data'));
    }

    public function showPost($postid)
    {
        $data=Post::where('id','=',$postid)->first() ;
     // print_r($data);
       $data['cat']=Categori::where('pub','=','0')->get()->pluck('name','id'); 

     //  print_r($data['cat']);
     //  exit;
        return view(config('moconf.tmpl').'.blogsingle',compact('data'));
    }
}
