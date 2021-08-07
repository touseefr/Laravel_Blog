<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\Category;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Contracts\View\View as ViewView;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    //returnig blog listing
    public function index()
    {
        return view('backend.blogs');
    }
    public function createblog()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('backend.createblog', compact('categories', 'tags'));
    }
    public function create(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        //  dd($user->id);
        $active = $request->active == 'on' ? 1 : 0;
        $this->validateblog($request);
        $uploadedimage = $request->file('image');
        $imagewithext = $uploadedimage->getClientOriginalName();
        $imgname = pathinfo($imagewithext, PATHINFO_FILENAME);
        $imgext = $uploadedimage->getClientOriginalExtension();
        $img = $imgname . "." . $imgext;
        // dd($image);
        $request->image->move(public_path('images/blogimages'), $img);

        $blog = Blog::create([
            'user_id' => $user->id,
            'category_id' => $request->category,
            'title' => $request->title,
            'url' => $request->url,
            'image' => $img,
            'image_alt' => $request->image_alt,
            'meta' => $request->meta,
            'short_description' => $request->short_description,
            'descriprtion' => $request->descriprtion,
            'active' => $active,
        ]);

        $blog->tags()->attach($request->tags);
        // $blog->save();
        return redirect()->back()->with('success', 'successfull..');
    }
    public function validateblog($request)
    {
        //dd($request->all());
        $request->validate([
            'title' => 'required|min:3',
            'url' => 'required|unique:blogs',
            'category' => 'required',
            'tags' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
            'image_alt' => 'required',
            'meta' => 'required',
            'short_description' => 'required',
            'descriprtion' => 'required|min:10'
        ]);
        return $request;
    }
    //get all blogs
    public function getallblog()
    {
        //dd("hhgh");
        // $blog = Blog::all()->pluck('title');
        // dd($blog);
        $blog=Blog::all();
        return Datatables::of($blog)
            ->editColumn('user_id', function ($blog) {
                return "<span class='badge badge-success badge-pill'>" . $blog->user->name . "</span>";
            })
            ->editColumn('category_id', function ($blog) {
                return "<span class='badge badge-dark badge-pill'>" . $blog->category->name . "</span>";
            })
            ->editColumn('short_description', function ($blog) {
                return Str::words($blog->short_description, 2, '...');
            })
            ->editColumn('descriprtion', function ($blog) {
                return Str::words($blog->descriprtion,7,'...');
            })
            ->editColumn('active', function ($blog) {
                if ($blog->active == '1')
                    return "<span class='badge badge-success badge-pill'>Active</span>";
                else {
                    return "<span class='badge badge-danger badge-pill'>Awaiting Approvol</span>";
                }
            })
            // ->addColumn('id', function (Blog $blog) {
            //     return $blog->tags->map(function ($tag) {
            //         return "<span class='badge badge-info badge-pill'>" . $tag->name . "</span>";
            //     })->implode('<br>');
            // })
            ->rawColumns(['user_id', 'id', 'category_id', 'descriprtion', 'active'])
            ->make(true);
    }
    public function editblog($id)
    {
        //dd($id);
        $categories = Category::all();
        $tags = Tag::all();
        $blog = Blog::find($id);
        // dd($blog);
        return view('backend.editblog', compact('blog', 'categories', 'tags'));
    }
    public function blogupdate(Request $request)
    {
       // dd("hehreupdate");
        //  dd($request->all());
        $blog = Blog::findOrFail($request->blog_id);
        //dd($blog);
        $this->updateblogvalidate($request);
        // dd('success');
        $active = $request->active == 'on' ? 1 : 0;
        //dd($active);
        $storeimg = $blog->image;
        //dd($storeimg);
        if ($request->has('image')) {
            $path = '/images/blogimages/';
            $image = $blog->image;
            $this->deleteimg($path, $image);
            $uploadedimage = $request->file('image');
            $imagewithext = $uploadedimage->getClientOriginalName();
            $imgname = pathinfo($imagewithext, PATHINFO_FILENAME);
            $imgext = $uploadedimage->getClientOriginalExtension();
            $storeimg = $imgname . "." . $imgext;
            // dd($image);
            $request->image->move(public_path('images/blogimages'), $storeimg);
        }
        $blog->title=$request->title;
        $blog->url=$request->url;
        $blog->category_id=$request->category;
        $blog->image=$storeimg;
        $blog->image_alt=$request->image_alt;
        $blog->meta=$request->meta;
        $blog->short_description=$request->short_description;
        $blog->descriprtion=$request->descriprtion;
        $blog->active=$active;
        $blog->save();
        $blog->tags()->sync($request->tags);
        return redirect()->back()->with('success','yayoooo');
    }
    //delete image
    public function deleteimg($path, $image)
    {
        //  dd($path);
        if (file_exists(public_path() . $path . $image)) {
            unlink(public_path() . $path . $image);
        }
    }
    //methd for updatevalidate blog
    public function updateblogvalidate($request)
    {
        if ($request->has('image')) {
            //dd('img yes');
            $request->validate([
                'title' => 'required|min:3',
                'url' => 'required|unique:blogs,url,' . $request->blog_id,
                'category' => 'required',
                'tags' => 'required',
                'image' => 'required|mimes:jpg,jpeg,png',
                'image_alt' => 'required',
                'meta' => 'required',
                'short_description' => 'required',
                'descriprtion' => 'required|min:10'
            ]);
        } else {
            //  dd('no imgg');
            $request->validate([
                'title' => 'required|min:3',
                'url' => 'required|unique:blogs,url,' . $request->blog_id,
                'category' => 'required',
                'tags' => 'required',

                'image_alt' => 'required',
                'meta' => 'required',
                'short_description' => 'required',
                'descriprtion' => 'required|min:10'
            ]);
            return $request;
        }
    }
    public function delblog($id)
    {
       // dd($id);
       $blog=Blog::findOrFail($id);
       if($blog)
       {
           $path='/images/blogimages';
           $image=$blog->image;
           $this->deleteimg($path,$image);

           $blog->delete();
           return 'success';
       }
       else{
           return 'fails...';
       }
    }
    public function await()
    {
       return view('backend.await');
    }
    public function getawait(){
        $blog = Blog::where('active',0)->get();
        return Datatables::of($blog)
            ->editColumn('user_id', function ($blog) {
                return "<span class='badge badge-success badge-pill'>" . $blog->user->name . "</span>";
            })
            ->editColumn('category_id', function ($blog) {
                return "<span class='badge badge-dark badge-pill'>" . $blog->category->name . "</span>";
            })
            ->editColumn('short_description', function ($blog) {
                return Str::words($blog->short_description, 2, '...');
            })
            ->editColumn('descriprtion', function ($blog) {
                return Str::words($blog->descriprtion,7,'...');
            })
            ->editColumn('active', function ($blog) {
                if ($blog->active == '1')
                    return "<span class='badge badge-success badge-pill'>Active</span>";
                else {
                    return "<span class='badge badge-danger badge-pill'>Awaiting Approvol</span>";
                }
            })
            // ->addColumn('id', function (Blog $blog) {
            //     return $blog->tags->map(function ($tag) {
            //         return "<span class='badge badge-info badge-pill'>" . $tag->name . "</span>";
            //     })->implode('<br>');
            // })
            ->rawColumns(['user_id', 'id', 'category_id', 'descriprtion', 'active'])
            ->make(true);

    }
    //admin approve blog
    public function approveblog($id)
    {
       // dd('asfff',$id);
       $blog=Blog::where('id',$id)->first();
       //dd($blog);
       $blog->active='1';
       $blog->save();
    }
// user awating blog
    public function userawait()
    {
      //  dd('userawwa');
      return view('userpanel.await');
    }
    //user blog approved
    public function userapproved()
    {
        //dd('userawwa');
      return view('userpanel.approved');
    }
    //awaiting blog for only this user
    public function getuserawatingblog()
    {
        $user_id=Auth::user()->id;
     //  dd($user_id);
      //  dd('hereee');
        $blog = Blog::where('user_id',$user_id)->where('active',0)->get();
        return Datatables::of($blog)
            ->editColumn('user_id', function ($blog) {
                return "<span class='badge badge-success badge-pill'>" . $blog->user->name . "</span>";
            })
            ->editColumn('category_id', function ($blog) {
                return "<span class='badge badge-dark badge-pill'>" . $blog->category->name . "</span>";
            })
            ->editColumn('short_description', function ($blog) {
                return Str::words($blog->short_description, 2, '...');
            })
            ->editColumn('descriprtion', function ($blog) {
                return Str::words($blog->descriprtion,7,'...');
            })
            ->editColumn('active', function ($blog) {
                if ($blog->active == '1')
                    return "<span class='badge badge-success badge-pill'>Active</span>";
                else {
                    return "<span class='badge badge-danger badge-pill'>Awaiting Approvol</span>";
                }
            })
            // ->addColumn('id', function (Blog $blog) {
            //     return $blog->tags->map(function ($tag) {
            //         return "<span class='badge badge-info badge-pill'>" . $tag->name . "</span>";
            //     })->implode('<br>');
            // })
            ->rawColumns(['user_id', 'id', 'category_id', 'descriprtion', 'active'])
            ->make(true);
    }
     //approved blog for only this user
     public function getuserapprovedblog()
     {
         $user_id=Auth::user()->id;
      //  dd($user_id);
       //  dd('hereee');
         $blog = Blog::where('user_id',$user_id)->where('active',1)->get();
         return Datatables::of($blog)
             ->editColumn('user_id', function ($blog) {
                 return "<span class='badge badge-success badge-pill'>" . $blog->user->name . "</span>";
             })
             ->editColumn('category_id', function ($blog) {
                 return "<span class='badge badge-dark badge-pill'>" . $blog->category->name . "</span>";
             })
             ->editColumn('short_description', function ($blog) {
                 return Str::words($blog->short_description, 2, '...');
             })
             ->editColumn('descriprtion', function ($blog) {
                 return Str::words($blog->descriprtion,7,'...');
             })
             ->editColumn('active', function ($blog) {
                 if ($blog->active == '1')
                     return "<span class='badge badge-success badge-pill'>Active</span>";
                 else {
                     return "<span class='badge badge-danger badge-pill'>Awaiting Approvol</span>";
                 }
             })
             // ->addColumn('id', function (Blog $blog) {
             //     return $blog->tags->map(function ($tag) {
             //         return "<span class='badge badge-info badge-pill'>" . $tag->name . "</span>";
             //     })->implode('<br>');
             // })
             ->rawColumns(['user_id', 'id', 'category_id', 'descriprtion', 'active'])
             ->make(true);
     }
    //user blog edit
    public function editblogviewuser($id)
    {
              //dd($id);
              $blog = Blog::find($id);
              if($blog && $blog->user_id==Auth::user()->id){
        $categories = Category::all();
        $tags = Tag::all();
     
        // dd($blog);
        return view('userpanel.editblog', compact('blog', 'categories', 'tags'));
              }
              else{
                  return abort(404);
              }
    }
}
