<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Mail;
use Validator;


//Models
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Config;

class Homepage extends Controller
{
    public function __construct(){
        if (Config::find(1)->active==0) {
            return redirect()->to('site-is-not-active')->send(); 
        }

        view()->share('pages', Page::where('status',1)->orderby('order','ASC')->get());
        view()->share('categories',Category::where('status',1)->orderby('id','DESC')->get());
    }

    // index function returns list of articles with slider
    public function index(){
        $data['articles']=Article::with('getCategory')->where('status',1)->whereHas('getCategory',function($query){
            $query->where('status',1);
        })->orderBy('created_at','DESC')->paginate(10);
        $data['articles'] -> withPath(url('.'));
        return view('front.homepage',$data);
    }  
 
    // single
    public function single($category,$slug){
        $category = Category::whereSlug($category)->first() ?? abort(403,'Tapilmadi');
        $article = Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403,'Tapilmadi');
        $article->increment('hit');
        $data['article']= $article;
        return view('front.single',$data);
    }

    public function category($slug){
        $category = Category::whereSlug($slug)->first() ?? abort(403,'Tapilmadi');
        $data['category'] = $category ;
        $data['articles'] = Article::where('category_id',$category->id)->where('status',1)->orderBy('created_at','DESC')->paginate(1);
        return view ('front.category', $data);
    }
    public function page ($slug){
        $page = Page::whereSlug($slug)->first() ?? abort(403,'Tapilmadi');
        $data['page'] = $page;
        return view('front.page',$data);
    }
    public function contact (){
        return view('Front.contact');  
    }
    public function contactpost(Request $request){

        $rules=[
            'name'=>'required|min:5',
            'email'=>'required|email',
            'topic'=>'required',
            'message'=>'required|min:10'
        ];
        $validate=Validator::make($request->post(),$rules);

        if ($validate->fails()) {
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }

        Mail::send([],[],function($message) use($request){
            $message->from('contact@blogsite.com','Blog Cite');
            $message->to('tunar036@gmail.com');
            $message->setBody('Message by: '.$request->name.'<br>
            The mail sending the message :'.$request->email.'<br>
            Message Subject : '.$request->topic.'<br>
            Message : '.$request->message.'<br><br>
            Message sent date : '.now().'',
            'text/html');
            $message->subject($request->name.' sent a message from Contact');
        });


        // $contact = new Contact;
        // $contact->name=$request->name;
        // $contact->email=$request->email;
        // $contact->topic=$request->topic;
        // $contact->message=$request->message;
        // $contact->save();
        return redirect()-> route('contact')->with('success','Your message has been sent to us');
    }
}
  