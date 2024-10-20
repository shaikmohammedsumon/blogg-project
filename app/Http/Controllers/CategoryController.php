<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('dashborad.category.index',compact('categories'));
    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required',
            'image' => 'required|image',
        ]);
        
        $manager = new ImageManager(new Driver());
        if($request->hasFile('image')){
            $newNAme = auth()->user()->id.'-'.$request->title.'-'.rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploads/category/'.$newNAme));

            if($request->slut){

                Category::insert([
                    'title' => Str::ucfirst($request->title),
                    'slug' => Str::slug($request->slug,'-'),
                    'image' => $newNAme,
                    'created_at' => now(),
                ]);
                return back()->with('create_category', 'Create Category Succesful');
            }else{
                Category::insert([
                    'title' => Str::ucfirst($request->title),
                    'slug' => Str::slug($request->title,'-'),
                    'image' => $newNAme,
                    'created_at' => now(),
                ]);
            }
            return back()->with('create_category', 'Create Category Succesful');

        }else{
           return back(); 
        }
    }


    public function edit($id ){
        $category = Category::where('id',$id)->first();
        return view('dashborad.category.edit',compact('category'));
    }

    public function update(Request $request, $id){
        $manager = new ImageManager(new Driver());
        $category = Category::where('id',$id)->first();
         $request->validate([
            'image' => 'image',
         ]);


         if($request->hasFile('image')){
            $newNAme = auth()->user()->id.'-'.$request->title.'-'.rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploads/category/'.$newNAme));

            if($category->image){
                $oldPath = base_path('public/uploads/category/'.$category->image);
                if(file_exists($oldPath)){
                    unlink($oldPath);
                }
            }

            if($request->slug){
                Category::find($category->id)->update([
                    'title' => Str::ucfirst($request->title),
                    'image' => $newNAme,
                    'slug' => Str::slug($request->slug,'-'),
                    'created_at' => now(),
                ]);
                return redirect()->route('category.index')->with('create_category', 'Create Update Succesful');
            }else{
                Category::find($category->id)->update([
                    'title' => Str::ucfirst($request->title),
                    'image' => $newNAme,
                    'slug' => Str::slug($request->title,'-'),
                    'created_at' => now(),
                ]);
                return redirect()->route('category.index')->with('create_category', 'Create Update Succesful');
            }



         }else{

            if($request->slug){
                Category::find($category->id)->update([
                    'title' => Str::ucfirst($request->title),
                    'slug' => Str::slug($request->slug,'-'),
                    'created_at' => now(),
                ]);
                return redirect()->route('category.index')->with('create_category', 'Create Update Succesful');
            }else{
                Category::find(id: $category->id)->update([
                    'title' => Str::ucfirst($request->title),
                    'slug' => Str::slug($request->title,'-'),
                    'created_at' => now(),
                ]);
                return redirect()->route('category.index')->with('create_category', 'Create Update Succesful');
            }

         }

    }

    public function delete($delete){
        $category = Category::where('id',$delete)->first();

        if($category->image){
            $oldPath = base_path('public/uploads/category/'.$category->image);
            if(file_exists($oldPath)){
                unlink($oldPath);
            }
        }
        Category::find($category->id)->delete();
        return back()->with('create_category', 'Create Delete Succesful');
    }

    public function action($action){
        $category = Category::where('id',$action)->first();

        if($category->status == 'deactive'){
            Category::find($category->id)->update([
                'status' => 'active',
            ]);
            return back()->with('create_category', 'This Create is active');
        }else{
            Category::find($category->id)->update([
                'status' => 'deactive',
            ]);
            return back()->with('create_category', 'This Create is deactive');
        }
    }

}
