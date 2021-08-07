<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Tag;
use Facade\FlareClient\Http\Response;
use Yajra\Datatables\Datatables;

class TagController extends Controller
{
    //
    public function index()
    {
        return view('backend.tags');
    }

    public function create(Request $request)
    {
      //dd($request->all());
      $request->validate([
          'tag_name'=>'required|min:3|max:12'
      ]);
    
      $slug=Str::slug($request->tag_name);
     // dd($slug);
     $tag=Tag::create([
         'name'=>$request->tag_name,
         'slug'=> $slug
     ]);
     return "success";
    }
   // get all tags using datatables
    public function getalltag()
    {
       // dd("herereee");
       $tag=Tag::all();
       return Datatables::of($tag)
    //    ->editColumn('created_at', '{!! $created_at !!}')
       ->editColumn('created_at', function ($tag) {
        return $tag->updated_at->format('d-M-Y');
        
    })
       ->editColumn('updated_at', function ($tag) {
           return $tag->updated_at->format('d-M-Y');
           
       })
       ->make(true);
    }
    //fetch data for edit tags  
   public function gettag($id)
   {
       // dd($id);
       $tag=Tag::find($id);
      // dd($category);
      if($tag)
      {
          return $tag;
      }
      else
      {
          return response()->json(['error'=>'Not Found'],404);
      }
   }
   //update tag
   public function updatetag(Request $request)
   {
      // dd($request->all());
      $request->validate([
          'edit_tag'=>'required'
      ]);
      $tag=Tag::find($request->tag_id);

      $tag->name=$request->edit_tag;
      $tag->slug=Str::slug($request->edit_tag);
      $tag->save();
      return "success";
   }
   //delete category
   public function deltag($id)
   {
       //dd($id);
       $tag=Tag::destroy($id);
       return $tag;

   }
}
