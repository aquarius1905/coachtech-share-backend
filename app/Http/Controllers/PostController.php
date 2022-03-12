<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Post::all();
        foreach($items as $item) {
            $user = User::where('id', $item->user_id)->first();
            $item->user_name = $user->name;
            $count = Like::where('post_id', $item->id)->count();
            $item->like_count = $count;
        }
        return response()->json([
            'data' => $items 
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = Post::create($request->all());
        $user = User::where('id', $request->user_id)->first();
        $item->user_name = $user->name;
        return response()->json([
            'data' => $item
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Post::find($id);
        if($item) {
            $user = User::where('id', $item->user_id)->first();
            $item->user_name = $user->name;
            $like = Like::where('post_id', $id)->count();
            $item->like_count = $like;
            return response()->json([
                'data' => $item,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $item = Post::where('id', $post->id)->delete();
        if($item) {
            Comment::where('post_id', $post->id)->delete();
            Like::where('post_id', $post->id)->delete();
            return response()->json([
                'message' => 'Deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
    }
}
