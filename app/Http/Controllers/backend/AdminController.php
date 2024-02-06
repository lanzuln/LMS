<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('backend.admin.dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin/login');
    }

    public function adminLogin()
    {
        return view('backend.admin.auth.pages.login');
    }

    public function adminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('backend.admin.pages.profile.profile', compact('profileData'));
    }

    public function adminProfileUpdate(Request $request)
    {
        $id = Auth::user()->id;

        if ($request->file('photo')) {
            $file = request()->file('photo');
            $fileName = time() . $file->getClientOriginalExtension();
            $file->move(public_path('/uploads/admin'), $fileName);
            $filePath = "uploads/admin/{$fileName}";

            User::where("id", $id)->update([
                'name' => $request->name,
                'username' => $request->name,
                'phone' => $request->name,
                'address' => $request->name,
                'photo' => $filePath,
            ]);
            toastr()->success('Profile update with images');
            return redirect()->back();
        }
        User::where("id", $id)->update([
            'name' => $request->name,
            'username' => $request->name,
            'phone' => $request->name,
            'address' => $request->name,
        ]);
        toastr()->success('Profile update without images');
        return redirect()->back();
    }

}
