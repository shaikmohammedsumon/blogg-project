<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(2);
        return view('dashborad.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorys = Category::where('status','active')->latest()->get();
        return view('dashborad.blog.create',compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $manager = new ImageManager(new Driver());

        // return $request;
        // die();

        $request->validate([
            'category_id'=> 'required',
            'thumbnail'=> 'required',
            'title'=> 'required',
            'short_descripion'=> 'required',
            'long_descripion'=> 'required',
        ]);


        if($request->hasFile('thumbnail')){
            $newName = auth()->user()->id.'-'.$request->title.'-'.rand(1111,9999).'.'.$request->file('thumbnail')->getClientOriginalExtension();
            $image = $manager->read($request->file('thumbnail'));
            $image->toPng()->save(base_path('public/uploads/blog/'.$newName));

            if($request->slug){
               Blog::create([
                'user_id' => Auth::user()->id,
                'category_id' => $request->category_id,
                'thumbnail' => $newName,
                'title' => $request->title,
                'slug' => Str::slug($request->slug,'-'),
                'short_descripion' => $request->short_descripion,
                'long_descripion' => $request->long_descripion,

               ]);
            return redirect()->route('blog.index')->with('success',"Blog Create successful");
            }else{
                Blog::create([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'thumbnail' => $newName,
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'short_descripion' => $request->short_descripion,
                    'long_descripion' => $request->long_descripion,

                   ]);
                return redirect()->route('blog.index')->with('success',"Blog Create successful");

            }

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $blogs = Blog::where('id',$blog->id)->first();
        $categorys = Category::where('status','active')->latest()->get();
        return view('dashborad.blog.edit',compact('blogs','categorys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {


        $manager = new ImageManager(new Driver());

        // return $request;
        // die();

        $request->validate([
            'category_id'=> 'required',
            'title'=> 'required',
            'short_descripion'=> 'required',
            'long_descripion'=> 'required',
        ]);


        if($request->hasFile('thumbnail')){
            $newName = auth()->user()->id.'-'.$request->title.'-'.rand(1111,9999).'.'.$request->file('thumbnail')->getClientOriginalExtension();
            $image = $manager->read($request->file('thumbnail'));
            $image->toPng()->save(base_path('public/uploads/blog/'.$newName));

            if($blog->thumbnail){
                $oldPath = base_path('public/uploads/blog/'.$blog->thumbnail);
                if(file_exists($oldPath)){
                    unlink($oldPath);
                }
            }

            if($request->slug){
               Blog::find($blog->id)->update([
                'user_id' => Auth::user()->id,
                'category_id' => $request->category_id,
                'thumbnail' => $newName,
                'title' => $request->title,
                'slug' => Str::slug($request->slug,'-'),
                'short_descripion' => $request->short_descripion,
                'long_descripion' => $request->long_descripion,

               ]);
            return redirect()->route('blog.index')->with('success',"Blog Create successful");
            }else{
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'thumbnail' => $newName,
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'short_descripion' => $request->short_descripion,
                    'long_descripion' => $request->long_descripion,

                   ]);
                return redirect()->route('blog.index')->with('success',"Blog Updated successful");

            }


        }else{

            if($request->slug){
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'short_descripion' => $request->short_descripion,
                    'long_descripion' => $request->long_descripion,

                    ]);
                return redirect()->route('blog.index')->with('success',"Blog Updated successful");

             }else{
                Blog::find($blog->id)->update([
                     'user_id' => Auth::user()->id,
                     'category_id' => $request->category_id,
                     'title' => $request->title,
                     'slug' => Str::slug($request->title,'-'),
                     'short_descripion' => $request->short_descripion,
                     'long_descripion' => $request->long_descripion,

                    ]);
                return redirect()->route('blog.index')->with('success',"Blog Updated successful");
             }

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {


        if($blog->thumbnail){
            $oldPath = base_path('public/uploads/blog/'.$blog->thumbnail);
            if(file_exists($oldPath)){
                unlink($oldPath);
            }
        }

        Blog::find($blog->id)->delete();
        return redirect()->route('blog.index')->with('success',"Blog Updated successful");
    }

    public function action($id){

        $blogs = Blog::where('id',$id)->first();


        if($blogs->status == 'deactive'){

            Blog::find($blogs->id)->update([
                'status' => 'active',
            ]);
        return back()->with('success',"Blog active successful");

        }else{
            Blog::find($blogs->id)->update([
                'status' => 'deactive',

            ]);
        return back()->with('success',"Blog deactive successful");

        }
    }



    public function feature($id){

        $blogs = Blog::where('id',$id)->first();

        if($blogs->feature == '0'){

            Blog::find($blogs->id)->update([
                'feature' => '1',
            ]);
        return back()->with('success',"Blog Feature active successful");

        }else{
            Blog::find($blogs->id)->update([
                'feature' => '0',

            ]);
        return back()->with('success',"Blog Feature deactive successful");

        }
    }
}
