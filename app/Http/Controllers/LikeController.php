<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($post_id)
    {
        $count = Like::where('post_id', $post_id)->count();
        if($count){
            return response()->json([
                'data' => $count
            ], 200);
        } else {
            return response()->json([
                'data' => "0"
            ], 200);
        }
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
     * Exist the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exists(Request $request)
    {
        $count = Like::where('user_id', $request->user_id)->where('post_id', $request->post_id)->get()->count();
        return response()->json([
            'data' => $count
        ], 200);
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Like  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $post_id)
    {
        $item = Like::where('user_id', $user_id)->where('post_id', $post_id)->delete();
        if($item) {
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
