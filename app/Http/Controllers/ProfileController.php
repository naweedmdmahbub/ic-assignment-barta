<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = auth()->user();
        return view('profile.profile', compact('profile'));
    }
    
    public function edit()
    {
        $profile = User::find(auth()->id());
        return view('profile.edit-profile', compact('profile'));
    }

    public function update(ProfileRequest $request)
    {
        $input = $request->validated();
        $input['password'] = Hash::make($input['password']);
        $request->bio ? $input['bio'] = $request->bio : $input[bio] = null;
        $profile = User::find(auth()->id())->fill($input);
        $profile->save();
        return redirect()->route('edit-profile');
    }
}
