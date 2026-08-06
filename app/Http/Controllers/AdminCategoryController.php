<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = FoodCategory::paginate(10);

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:food_categories,name',
        ]);

        FoodCategory::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin.categories')
            ->with('success', 'Category added successfully.');
    }

    public function edit(FoodCategory $category)
    {
        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, FoodCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:food_categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin.categories')
            ->with('success', 'Category updated successfully.');
    }

public function destroy(FoodCategory $category)
    {
        if ($category->foodDonations()->exists()) {

            return redirect()
                ->route('admin.categories')
                ->with('error', 'Cannot delete category because it is being used by existing donations.');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories')
            ->with('success', 'Category deleted successfully.');
    }

}