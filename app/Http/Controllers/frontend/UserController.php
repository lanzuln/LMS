<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return view('frontend.dashboard.pages.index');
    }

    public function edit(){
        $id= Auth::user()->id;
        $profileData= User::find($id);
        return view('frontend.dashboard.pages.profileEdit', compact('profileData'));
    }
}
