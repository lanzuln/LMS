<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.admin.pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.admin.pages.category.create');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = request()->file('image');
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/uploads/category'), $fileName);
            $filePath = "uploads/category/{$fileName}";

            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'image' => $filePath,
            ]);
            toastr()->success('Category created');
            return redirect()->back();
        }
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        toastr()->success('Category created Without images');
        return redirect()->back();

    }
}
