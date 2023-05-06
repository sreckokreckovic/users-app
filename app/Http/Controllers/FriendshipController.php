<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFriendshipRequest;
use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
   public function index()
   {

       $friendships= Friendship::query()->where('status','accepted')->where('user_id',auth()->user()->id)->
       orWhere('friend_id',auth()->user()->id)->get();
       return view('friendship.index',compact('friendships'));
   }

    public function showRequests()
    {
        $requests= Friendship::query()->where('status','pending')->where('friend_id',auth()->user()->id)->get();
        return view('friendship.request',compact('requests'));
    }

    public function update(Friendship $friendship)
    {
        Friendship::query()->where('id',$friendship->id)->update(['status'=>'accepted']);


        return back();
    }

    public function destroy(Friendship $friendship)
    {
        $friendship->delete();

        return back();
    }

}



