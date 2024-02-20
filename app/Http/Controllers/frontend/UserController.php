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

    public function update(Request $request){

        $id = Auth::user()->id;
        $user = User::find($id);
        $old_image = $user->photo;

        if ($request->file('photo')) {
            $file = request()->file('photo');
            $fileName = time() . "." . $file->getClientOriginalExtension();
            $file->move(public_path('/uploads/user/'), $fileName);
            if (file_exists($old_image)) {
                unlink($old_image);
            }
            $filePath = "uploads/user/{$fileName}";
            User::where("id", $id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'phone' => $request->phone,
                'address' => $request->address,
                'photo' => $filePath,
            ]);
            toastr()->success('Profile update with images');
            return redirect()->back();
        }
        User::where("id", $id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        toastr()->success('Profile update without images');
        return redirect()->back();

    }
}
