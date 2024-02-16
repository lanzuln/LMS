<?php

namespace App\Http\Controllers\backend\instructor;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
    public function index()
    {
        return view('backend.instructor.dashboard');
    }
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('instructor/login');
    }

    public function instructorLogin()
    {
        return view('backend.instructor.auth.pages.login');
    }

    public function instructorProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('backend.instructor.pages.profile.profile', compact('profileData'));
    }

    public function instructorProfileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $old_image = $user->photo;

        if ($request->file('photo')) {
            $file = request()->file('photo');
            $fileName = time() . "." . $file->getClientOriginalExtension();
            $file->move(public_path('/uploads/instructor/'), $fileName);
            if (file_exists($old_image)) {
                unlink($old_image);
            }
            $filePath = "uploads/instructor/{$fileName}";
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

    public function instructorPassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('backend.instructor.pages.profile.instructorPassword', compact('profileData'));
    }
    public function instructorPasswordChange(request $request)
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
}
