<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        return $this->success($categories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'nullable|string|max:50',
        ]);

        $slug = str()->slug($validated['name']);
        $id = $request->id ?? $slug;

        $category = Category::create([
            'id' => $id,
            'name' => $validated['name'],
            'slug' => $slug,
            'filter_class' => 'filter-' . $slug,
            'icon' => $validated['icon'] ?? 'bi-folder',
        ]);

        return $this->created($category);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|max:50',
            'name' => 'required|string|max:100',
            'icon' => 'nullable|string|max:50',
        ]);

        $category = Category::find($validated['id']);

        if (!$category) {
            return $this->notFound('Category');
        }

        $slug = str()->slug($validated['name']);

        $category->update([
            'name' => $validated['name'],
            'slug' => $slug,
            'filter_class' => 'filter-' . $slug,
            'icon' => $validated['icon'] ?? 'bi-folder',
        ]);

        return $this->success($category->fresh());
    }

    public function destroy(Request $request)
    {
        $id = $request->query('id');

        $category = Category::find($id);

        if (!$category) {
            return $this->notFound('Category');
        }

        $category->delete();

        return $this->deleted();
    }
}
