<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\Category;
use App\Models\RequsetModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Abouts;
use App\Models\ConnectedModel;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $connecteds = ConnectedModel::where('status','active')->latest()->get();
        $popularPosts = Blog::orderBy('view_count', 'desc')->take(4)->get();
        $features = Blog::where('feature',"1")->take(3)->latest()->get();
        $ablogs =  Blog::latest()->take(5)->get();
        $categorys = Category::where('status','active')->latest()->get();
        return view('frontend.home.index',compact('categorys','ablogs','features','popularPosts','connecteds'));
    }


    public function show($slug){

        $categorys = Category::where('slug',$slug)->where('status' ,'active')->first();
        $blogs = Blog::where('category_id',$categorys->id)->where('status' ,'active')->latest()->paginate(5);
        return  view('frontend.category.index',compact('blogs','categorys'));

    }


    public function search(Request $request){
        $search = $request->search_text;
        $searchResults = Blog::where('title','LIKE','%' .$request->search_text .'%')->get();
        $popularPosts = Blog::orderBy('view_count', 'desc')->take(4)->get();
        $categorys = Category::where('status','active')->latest()->get();
        $features = Blog::where('feature',"1")->take(3)->latest()->get();
        $connecteds = ConnectedModel::where('status','active')->latest()->get();

        return view('frontend.search.index',compact('searchResults','search','popularPosts','categorys','features','connecteds'));
    }

    public function authors(Request $request){
        $blogs = Blog::latest()->paginate(5);

        $search = $request->search_text;
        $searchResults = Blog::where('title','LIKE','%' .$request->search_text .'%')->get();
        $popularPosts = Blog::orderBy('view_count', 'desc')->take(4)->get();
        $categorys = Category::where('status','active')->latest()->get();
        $features = Blog::where('feature',"1")->take(3)->latest()->get();
        $connecteds = ConnectedModel::where('status','active')->latest()->get();

        return view('frontend.authors.index',compact('blogs','searchResults','search','popularPosts','categorys','features','connecteds'));

    }


    public function abouts(){
        $abouts = Abouts::where('status','active')->first();
        return view('frontend.abouts.index',compact('abouts'));
    }


    public function contract(){
        return view('frontend.contract.index');
    }

    public function contract_created(){

    }





}
