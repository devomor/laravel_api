<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return response()->json([
            'success' => true,
            "message" => "All posts",
            'data' => $posts,
        ]);
    }

  
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'category_id' => 'required|integer',
            'title' => 'required|string|max:180|unique:posts',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'content' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => "Error Occurred",
                'errors' => $validator->getMessageBag(),
            ],422);
        }
        $data =$validator->validated();
        $data['slug']=Str::slug($data['title']);

        if(array_key_exists('photo',$data)){
            $data['photo'] = Storage::putFile('',$data['photo']);
        }
        Post::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Post Create Successfully',
            'data' => [],
        ],201);

    }

    public function show(Post $post)
    {
        return response()->json([
            'success' => true,
            'message' => "Post details",
            'data' => $post,
        ]);
       
    }

  
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(),[
            'category_id' => 'required|integer',
            'title' => 'required|string|max:180|unique:posts',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'content' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => "Error Occurred",
                'errors' => $validator->getMessageBag(),
            ],422);
        }
        $data =$validator->validated();
        $data['slug']=Str::slug($data['title']);

        if(array_key_exists('photo',$data)){
            Storage::delete($post->photo);
            $data['photo'] = Storage::putFile('',$data['photo']);
        }
        Post::update($data);
        return response()->json([
            'success' => true,
            'message' => 'Post update Successfully',
            'data' => []
        ],201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Storage::delete($post->photo);
        $post -> delete();

         return response()->json([
            'success' => true,
            'message' => 'Post deleted Successfully',
            'data' => []
        ]);
    }
}
