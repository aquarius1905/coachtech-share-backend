<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = User::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = ($request->id) ?
            User::where('id', $request->id)->first() :
            User::where('email', $request->email)->first();
        if ($user) {
            if ($request->id) {
                return response()->json([
                    'name' => $user->name,
                ], 200);
            }
            return response()->json([
                'id' => $user->id,
            ], 200);
        }

        return response()->json([
            'message' => 'Not found'
        ], 404);
    }
}
