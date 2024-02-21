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
    public function edit(Request $request, $id)
    {
        $category=Category::findOrFail($id);
        return view('backend.admin.pages.category.edit', compact('category'));
    }

    public function update(Request $request)
    {
        $id=$request->id;
        $category = Category::findOrFail($id);
        $old_Image= $category->image;

        if ($request->hasFile('image')) {
            $file = request()->file('image');
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/uploads/category'), $fileName);

            if (file_exists($old_Image)) {
                unlink($old_Image);
            }
            $filePath = "uploads/category/{$fileName}";

            Category::where('id', $id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'image' => $filePath,
            ]);
            toastr()->success('Category updated');
            return redirect()->back();
        }

        Category::where('id', $id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        toastr()->success('Category updated Without images');
        return redirect()->back();
    }

    public function delete($id) {
        $category = Category::find($id);
        $old_image = $category->category_image;

        unlink($old_image);
        Category::where('id', $id)->delete();
        toastr()->success('Category deleted');
        return back();
    }
}
