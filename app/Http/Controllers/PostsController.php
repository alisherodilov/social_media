<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(){
        $posts = Posts::all();
        return view("backend.pages.posts.index" , compact("posts"));
    }
    public function create(){
        $users = \App\User::all();
        $categories = \App\Models\Categories::all();
        return view("backend.pages.posts.create" , compact("users" , 'categories'));
    }
    public function store(Request $request){
        $request->validate([
            'user_id'=>'required',
            'describtion'=>'required',
            'like'=>'required',
            'photo'=>'required',
            'category_id'=>'required'
        ]);
       
    
     
        $client  = Posts::create([
            'user_id'=>$request->user_id,
            'describtion'=>$request->describtion,
            'likes'=>$request->like,
            'category_id'=>$request->category_id
        ]);
        if($request->hasFile('photo') && $request->file('photo')->isValid()){ 
         
            $client->addMediaFromRequest('photo')->toMediaCollection("photo");
        }
   
        return redirect()->route("admin.index");
    }
    public function delete(Request $request , $id){
        $post = Posts::find($id)->delete();
        return redirect()->route("admin.index");
    }
}
