<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use App\Http\Requests\AddMessageRequest;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try{
            $messages = Message::all();
            if($messages){
                return response()->json([
                    'data'=> $messages
                ],200);
            }
            return response()->json([
                'message'=>"empty"

            ],404);
        }
        catch(\Exception $e){
            return response()->json([
                'message'=>'internal error'
            ],500);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddMessageRequest $request)
    {
        //
        $message = new Message();
        $message->fill($request->all());//because we used fillable
        if($message->save()){ //returns a boolean
            return response()->json([
                'data'=> $message
            ],200);
        }
        else
        {
            return response()->json([
                'message'=>'message could not be added' 
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $message = Message::find($id);
        if($message)
        {
            return response()->json([
                'data'=> $message
            ],200);
        }
        return response()->json([
            'message'=>'message could not be found' 
        ],500);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(AddMessageRequest $request, $id)
    {
        //
        $message = Message::find($id);
        //what is the best way to validate the update request
        if($message){
            $message->update($request->all());//because we used fillable
            if($message->save()){ //returns a boolean
                return response()->json([
                    'data'=> $message
                ],200);
            }
            else
            {
                return response()->json([
                    'message'=>'message could not be updated' 
                ],500);
            }
        }
        return response()->json([
            'message'=>'message could not be found' 
        ],500);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $message = Message::find($id);
        if($message->delete()){ //returns a boolean
            return response()->json([
                'message'=> "good for you"
            ],200);
        }
        else
        {
            return response()->json([
                'message'=>'message could not be deleted' 
            ],500);
        }

    }
}
