<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\Category\CreateCategoryRequest;

class CategoryService
{
    /**
     * @return Collection;
     */
    public function getAll(): Collection
    {
        return Category::all();
    }

    public function store(CreateCategoryRequest $request)
    {
        return Category::create([
            'name' => $request->input('name')
        ]);
    }
}
