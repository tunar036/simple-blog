<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Article;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
        return view('back.categories.index',compact('categories'));
    }
    public function create(Request $request){
        $isExist =Category::whereSlug(str::slug($request->category))->first();
        if($isExist){
            toastr()->error('"'.$request->category.'"'.' named category already exists!');
            return redirect()->back();
        }
        $category = new Category;
        $category->name =$request->category;
        $category->slug =str::slug($request->category);
        $category->save();
        toastr()->success('Category successfully created!');
        return redirect()->back();
    }
    public function update(Request $request){
        $isSlug =Category::whereSlug(str::slug($request->slug))->whereNotIn('id',[$request->id])->first();
        $isName =Category::whereName($request->category)->whereNotIn('id',[$request->id])->first();
        if($isSlug or $isName){
            toastr()->error('"'.$request->category.'"'.' named category already exists!');
            return redirect()->back();
        }
        $category = Category::find($request->id);
        $category->name =$request->category;
        $category->slug =str::slug($request->slug);
        $category->save();
        toastr()->success('Category successfully updated!');
        return redirect()->back();
    }

    public function delete(Request $request){
        $category = Category::findOrFail($request->id);
          if ($category->id==1) {
            toastr()->error('This category can not be deleted.');
            return redirect()->back();
          }
          $message ='';
          $count = $category->articleCount();
          if ($count>0) {
              Article::where('category_id',$category->id)->update(['category_id'=>1]);
              $defaultCategory = Category::find(1);
              $message = $count.' articles belonging to this category have been moved to the "'.$defaultCategory->name.'" category' ;
          }
          $category->delete();
          toastr()->success($message, 'Category successfully deleted.');    
          return redirect()->back();
    }  

    public function getData(Request $request){
        $category=Category::findOrFail($request->id);
        return response()->json($category);
    }

    public function switch(Request $request){
        $category=Category::findOrFail($request->id);
        $category->status=$request->statu=="true" ? 1 : 0;
        $category->save();
    }
}
