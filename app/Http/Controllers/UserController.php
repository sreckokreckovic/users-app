<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddFriendRequest;
use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){


        $users = User::where('id', '<>', '1')->where('id', '<>', Auth::id())->paginate(5);
        return view('user.index', compact('users'));
    }
    public function addFriend(AddFriendRequest $request)
    {
        Friendship::query()->create($request->validated());
        return back();
    }



}
