<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class FrontController extends Controller
{
    //homepage
    public function index()
    {
        $blogs=Blog::where('active',1)->orderBy('id','desc')->paginate(2);
       // dd($blog);
        return view('frontend.blog',compact('blogs'));
    }
    public function blogd($url)
    {
       // dd('here');
        $blog=Blog::where('url',$url)->first();
       // dd($blog);
        return view('frontend.blog_detail',compact('blog'));
    }
}
