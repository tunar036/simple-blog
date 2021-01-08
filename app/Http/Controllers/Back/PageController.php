<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Page;
use File;

class PageController extends Controller
{
    public function index(){
        $pages = Page::all();
        return view('back.pages.index',compact('pages'));
    }
    public function orders(Request $request){
        foreach($request->get('page') as $key => $order){
            Page::where('id',$order)->update(['order'=>$key]);
        }
    }
    public function create(){
        return view('back.pages.create');
    }
    public function update($id){
        $page = Page::findOrFail($id);
        return view('back.pages.update',compact('page'));
    }
    public function updatePost(Request $request, $id)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $page = Page::findOrfail($id);
        $page->title = $request->title;
        $page->content = $request->content;
        $page->slug = str::slug($request->title);

        if($request->hasFile('image')){
             $imageName = str::slug($request->title).'.'.$request->image->getclientoriginalextension();
             $request->image->move(public_path('uploads'),$imageName);
             $page->image = 'uploads/'.$imageName;
        }
            $page->save();
            toastr()->success('Page updated successfully!');
            return redirect()->route('admin.page.index');
    }

    public function post(Request $request){
        $request->validate([
            'title'=>'min:3',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $last = Page::orderBy('order','desc')->first();
        $page = new Page;
        $page->title = $request->title;
        $page->content = $request->content;
        $page->order = $last->order+1;
        $page->slug = str::slug($request->title);

        if($request->hasFile('image')){
             $imageName = str::slug($request->title).'.'.$request->image->getclientoriginalextension();
             $request->image->move(public_path('uploads'),$imageName);
             $page->image = 'uploads/'.$imageName;
        }
            $page->save();
            toastr()->success('Page created successfully!');
            return redirect()->route('admin.page.index');
    }
    public function delete($id){
        $page = Page::find($id);
        if(File::exists($page->image)){
            File::delete(public_path($page->image));
        }
        $page->delete();
        toastr()->success('Page successfully deleted');
        return redirect()->back();
    }

    public function switch(Request $request){
        $page = Page::findOrfail($request->id);
        $page->status=$request->statu=='true' ? 1 : 0;
        $page->save(); 
}
}
