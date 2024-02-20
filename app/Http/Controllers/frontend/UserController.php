<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function changePassword(){
        return view('frontend.dashboard.pages.userPasswordChange');
    }

    public function updatePassword(request $request)
    {
        request()->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            toastr()->error('Old Password does not match');
            return redirect()->back();
        }
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);
        toastr()->success('Password changes Successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }

}
