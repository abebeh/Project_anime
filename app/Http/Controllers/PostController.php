<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest; 
use App\Models\Post;
use Cloudinary;
use Illuminate\Support\Facades\Auth;
use MatanYadaev\EloquentSpatial\Objects\Point;
/*
@param Object Post
@return Response post view
*/

class PostController extends Controller
{
    public function index(Post $post)
    {
        $api_key = config('app.api_key');
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit(),'api_key' => $api_key]);
    }
    
    public function create()
    {
        $api_key = config('app.api_key');
        return view('posts.create')->with(['api_key' => $api_key]);
    }
    
    public function store(PostRequest $request, Post $post)
    {   
        $input = $request['post'];
        $lat = $request['lat'];
        $lng = $request['lng'];
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input += ['image_url' => $image_url];
        $input += ['user_id' => Auth::id()]; 
        $input += ['anime_id' => 1 ];
        $point = new Point($lat,$lng) ;
        $input += ['point' => $point];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }

    
    public function show(Post $post)
    {   
        $api_key = config('app.api_key');
        return view('posts.show')->with(['post' => $post,'api_key' => $api_key]);
    }
    
    public function edit(Post $post)
    {
        $api_key = config('app.api_key');
        return view('posts.edit')->with(['post' => $post, 'api_key' => $api_key]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $input_post += ['user_id' => $request->user()->id];
        $post->fill($input_post)->save();
        return redirect('/posts/' .$post->id);
    }
    

    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    public function map()
    {
        $test = '投稿です。';
        $api_key = config('app.api_key');
        return view('map')->with(['test' => $test,'api_key' => $api_key]);
    }
    
}

