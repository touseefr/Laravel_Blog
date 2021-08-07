<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\Blog;

class BackendController extends Controller
{

    //admin dashboard
    public function dashb()
    {
        $catcount=Category::count();
        $tagscount=Tag::count();
        $blogcount=Blog::all()->count();
        $publishbc=Blog::where('active',1)->count();
        $awaitbc=Blog::where('active',0)->count();
        $usercount=User::count();
        return view('backend.dashboard',compact('catcount','tagscount','publishbc','awaitbc','usercount','blogcount'));
    }
    //user dashboard
    public function userdash()
    {
        return view('userpanel.dashboard');
    }
     //user create blog
    public function createblog()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('userpanel.createblog', compact('categories', 'tags'));
    }
}
