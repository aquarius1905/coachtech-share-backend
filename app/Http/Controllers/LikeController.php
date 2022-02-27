<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int $post_id
     * @return \Illuminate\Http\Response
     */
    public function show($post_id)
    {
        $count = Like::where('post_id', $post_id)->count();
        return response()->json([
            'data' => $count
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
        $item = Like::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $post_id)
    {
        $item = Like::where([
            ['user_id', '=', $user_id],
            ['post_id', '=', $post_id]
        ])->delete();
        if($item) {
            return response()->json([
                'message' => 'Deleted Successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
    }
}
