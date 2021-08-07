<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use Facade\FlareClient\Http\Response;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    //
    public function index()
    {
        return view('backend.categories');
    }

    public function create(Request $request)
    {
      //dd($request->all());
      $request->validate([
          'category_name'=>'required|min:3|max:12'
      ]);
    
      $slug=Str::slug($request->category_name);
     // dd($slug);
     $category=Category::create([
         'name'=>$request->category_name,
         'slug'=> $slug
     ]);
     return "success";
    }
   // get all categories using datatables
    public function getallcat()
    {
       // dd("herereee");
       $categories=Category::all();
       return Datatables::of($categories)
    //    ->editColumn('created_at', '{!! $created_at !!}')
       ->editColumn('created_at', function ($categories) {
        return $categories->updated_at->format('d-M-Y');
        
    })
       ->editColumn('updated_at', function ($categories) {
           return $categories->updated_at->format('d-M-Y');
           
       })
       ->make(true);
    }
    //edit category 
   public function getcat($id)
   {
       // dd($id);
       $category=Category::find($id);
      // dd($category);
      if($category)
      {
          return $category;
      }
      else
      {
          return response()->json(['error'=>'Not Found'],404);
      }
   }
   //update category
   public function updatecat(Request $request)
   {
      // dd($request->all());
      $request->validate([
          'edit_category'=>'required'
      ]);
      $category=Category::find($request->category_id);

      $category->name=$request->edit_category;
      $category->slug=Str::slug($request->edit_category);
      $category->save();
      return "success";
   }
   //delete category
   public function delcat($id)
   {
       //dd($id);
       $category=Category::destroy($id);
       return $category;

   }

}
