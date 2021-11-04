<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\Category\{CreateCategoryRequest, EditCategoryRequest};

class CategoryService
{
    /**
     * @return Collection;
     */
    public function getAll(): Collection
    {
        return Category::all();
    }

    /**
     * @param CreateCategoryRequest $request
     * @return Category
     */
    public function store(CreateCategoryRequest $request): Category
    {
        return Category::create([
            'name' => $request->input('name')
        ]);
    }

    /**
     * @param EditCategoryRequest $request
     * @param Category $category
     * @return Category
     */
    public function update(EditCategoryRequest $request, Category $category): Category
    {
        $category->update([
            'name' => $request->input('name')
        ]);
        return $category;
    }

    /**
     * @param Category $category
     * @throws
     */
    public function destroy(Category $category)
    {
        $category->delete();
    }
}
