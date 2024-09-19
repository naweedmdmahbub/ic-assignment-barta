<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $input = $request->validated();
        $input['password'] = Hash::make($input['password'] );
        User::insert($input);
        return redirect('/login');
    }
}
