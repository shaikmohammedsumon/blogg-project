<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\Category;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::where('status',"active")->latest()->get();
        return view('frontend.blog.index',compact('blogs'));
    }


    public function singel_index($id){


        // return $id;
        $viewCount = Blog::findOrFail($id);
        $viewCount->increment('view_count');

        $categorys = Category::where('status','active')->latest()->get();
        $blogs = Blog::where('id',$id)->first();
        $comments = BlogComment::with('replies')->where('blog_id',$blogs->id)->whereNull('parent_id')->get();
        return view('frontend.blog.singerl',compact('blogs','comments','categorys'));
    }


    public function comment(Request $request,$id){

        $request->validate([
            'name' => "required",
            'email' => "required",
            'comment' =>"required",
        ]);

        BlogComment::create([
            'user_id' => Auth::user()->id,
            'blog_id' => $id,
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'created_at' => now(),
        ]);

        return back();
    }



}
