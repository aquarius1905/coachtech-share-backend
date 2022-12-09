<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int $post_id
     * @return \Illuminate\Http\Response
     */
    public function show($post_id)
    {
        $items = Comment::where('post_id', $post_id)->get();
        if ($items) {
            foreach ($items as $item) {
                $user = User::where('id', $item->user_id)->first();
                $item->user_name = $user->name;
            }
            return response()->json([
                'data' => $items,
            ], 200);
        }
        return response()->json([
            'message' => 'Not found'
        ], 404);
    }

    public function countComments(Request $request)
    {
        $count = Comment::where('post_id', $request->id)->count();
        return response()->json([
            'count' => $count,
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
        $item = Comment::create($request->all());
        $user = User::where('id', $item->user_id)->first();
        $item->user_name = $user->name;
        return response()->json([
            'data' => $item
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $post_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id)
    {
        $item = Comment::where('post_id', $post_id)->delete();
        if ($item) {
            return response()->json([
                'data' => 'Deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
    }
}
