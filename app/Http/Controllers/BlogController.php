<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\blogImage;
use Illuminate\Support\Facades\Crypt;

class BlogController extends Controller
{
    public function index(){
        $blogs=blog::orderBydesc('id')->paginate(5); 
        return view('homepage',['blogs'=>$blogs]);
    }

    public function storeblog(Request $request){
        if($request->hasFile('image')){
            $imageFile = $request->file('image');
            $fileName = time() . '.' . $imageFile->getClientOriginalExtension();
            $extension = $imageFile->getClientOriginalExtension();
            $fileNamestore = $fileName;
            $request->file('image')->move(public_path('blogs'), $fileName);
            $title=$request->title;
            $description=$request->description;
            $userid=auth()->user()->id;

            $addblog=new blog;
            $addblog->user_id=$userid;
            $addblog->blogtitle=$title;
            $addblog->blogdescription=$description;
            $addblog->save();

            $addblogimage=new blogImage;
            $addblogimage->user_id=$addblog->id;
            $addblogimage->blog_image=$fileNamestore;
            $addblogimage->save();
            
            return response()->json(['status'=>'success']);
        }else{
            return response()->json(['status'=>'fail','message'=>'Something went wrong']);
        }
    }

    public function blogpagefun(Request $request){
        $id=Crypt::decrypt($request->blogid);
        $blogs=blog::where('id',$id)->first();
        $bloglist=blog::where('id','!=',$id)->orderBydesc('id')->get();
        return view('blogdetailpage',['blogs'=>$blogs,'bloglist'=>$bloglist]);
    }
}
