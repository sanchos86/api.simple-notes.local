<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Requests\Category\{CreateCategoryRequest, EditCategoryRequest};

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $categories = $this->categoryService->getAll();
        return CategoryResource::collection($categories);
    }

    /**
     * @param CreateCategoryRequest $request
     * @return CategoryResource
     */
    public function store(CreateCategoryRequest $request): CategoryResource
    {
        $category = $this->categoryService->store($request);
        return new CategoryResource($category);
    }

    /**
     * @param EditCategoryRequest $request
     * @param Category $category
     * @return CategoryResource
     */
    public function update(EditCategoryRequest $request, Category $category): CategoryResource
    {
        $category = $this->categoryService->update($request, $category);
        return new CategoryResource($category);
    }

    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        try {
            $this->categoryService->destroy($category);
            return response()->json([], 204);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
