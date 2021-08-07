<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class TestController extends Controller
{
    //
    public function test(){
        $blog=Blog::all()->pluck('meta');
       // dd($blog);
    }
}
