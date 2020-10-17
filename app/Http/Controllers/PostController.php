<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();
        return response()->json($post);
    }

    public function getItem(Request $request, Post $post)
    {

        $post = $post->newQuery();
        // Serach for a Code
        if ($request->has('code')) {
            return $post->where('code', 'LIKE', '%' . $request->input('code') . '%')->get();
        }

        //Serach for a Name 
        if ($request->has('name')) {
            return $post->where('name',  'LIKE', '%' . $request->input('name')  . '%')->get();
        }

        return $post->all();
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        if (post::where('name', $request->name)->exists()) {
            echo ('name is exists!!');
        } else {
            $post = new Post;
            $post->code = Str::random(12);
            $post->name = $request->name;
            $post->description = $request->description;
            $post->save();
            return response([
                'data' => $post
            ], 201);
        }
    }

    public function show($code)
    {
        $post = Post::where('code', $code)->first();
        if (!empty($post)) {
            return response()->json($post);
        } else {
            echo "Opps!!! Data Post Not Exist";
        }
    }

    public function update(Request $request, $code)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        if (post::where('name', $request->name)->exists()) {
            echo ('name is exists!!');
        } else {
            $post = Post::where('code', $code)->first();
            $post->name = $request->name;
            $post->description = $request->description;
            $post->update();
            return response([
                'data' => $post
            ], 201);
        }
    }

    public function destroy($code)
    {
        $post = Post::where('code', $code)->first();
        $post->delete();
        return response(["Successfully Delete"], 204);
    }
}
