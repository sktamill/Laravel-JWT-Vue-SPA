<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        return view('main.index');
    }

    public function storeUsers(StoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $user = User::where('email', $data['email'])->first();
        if($user) return response(['error' => 'User is already exists!'],403);

        $user = User::create($data);

        $token = auth()->tokenById($user->id);

        return response(['access_token' => $token]);
    }
}
