<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;




class AdminController extends Controller
{
    public function index()

    {
        $users = User::where('id', '<>', '1')->paginate(5);


        return view('admin.index', compact('users'));
    }


    public function create()
    {

        return view('admin.create');
    }

    public function store(StoreUserRequest $request)
    {

        User::query()->create($request->validated());
        return redirect()->route('admin.index');
    }

    public function edit(User $user)
    {
        return view('admin.edit',['user'=>$user]);
    }


    public function update(UpdateUserRequest $request, User $user)
    {

        User::query()->where('id',$user->id)->update($request->validated());

        return redirect()->route('admin.index');
    }

    public function destroy(User $user, Request $request)
    {
        $redirectPage=$this->calculatePage($request->perPage,$request->total,$request->currentPage);
        $user->delete();

        return redirect()->route('admin.index',['page'=>$redirectPage]);
    }

     private function calculatePage($perPage,$total,$currentPage){
        if($total<$perPage)
            return 1;
        $numOfElemCurrentPage=$total-($currentPage-1)*$perPage;
        if($numOfElemCurrentPage==1)
            return $currentPage-1;
        return $currentPage;
     }


}
