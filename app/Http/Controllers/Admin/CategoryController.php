<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CategoryRequest as CRequest;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function form($id = null)
    {
        $category = Category::getOrCreateCategory($id);
        return view('admin.categories.form', compact('category'));
    }

    public function save(CRequest $request, $id = null)
    {
        $category = Category::getOrCreateCategory($id);
        $menuLocation = !empty($request->post('location')) ? $request->post('location') : null;
        $category->name = $request->post('name');
        $category->location = $menuLocation;
        $category->slug = Str::slug($request->post('slug'));
        $category->description = $request->post('description');

        $result = $category->save();
        if ($result) {
            return redirect()->route('categories.form', $category->id)
                ->with(['success' => 'Kategoriya muvaffaqiyatli saqlandi!']);
        }
        return redirect()->back()->withErrors(['msg' => 'No\'malum xatolik, qayta urinib ko\'ring']);
    }
}
