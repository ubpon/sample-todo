<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->list();

        return Inertia::render('Category/Index', ['categories' => $categories]);
    }

    public function store(SaveCategoryRequest $request)
    {
        $this->categoryService->create($request->validated());

        return redirect()->back();
    }

    public function update(SaveCategoryRequest $request, Category $category)
    {
        $this->categoryService->update($category, $request->validated());

        return redirect()->back();
    }
}
