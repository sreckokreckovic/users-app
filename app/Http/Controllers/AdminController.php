<?php

namespace App\Http\Controllers;
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

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',

        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),

        ]);

        return redirect()->route('admin.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        if ($user->isSuperadmin()) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        if ($user->isSuperadmin()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,{$user->id}",

        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,

        ]);

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
