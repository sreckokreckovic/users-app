<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Friendship;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Friendship $friendship){
        $id=$friendship->friend->id;
        $messages=Message::query()->where('sender_id',Auth::id())->orWhere('sender_id',$id)->orWhere('receiver_id',Auth::id())->orWhere('receiver_id',$id)->get();
        return view('message.index',['friendship' => $friendship, 'messages' => $messages]);
    }
    public function store(StoreMessageRequest $request){
        Message::query()->create($request->validated());
        return view('message.index');

    }
}
