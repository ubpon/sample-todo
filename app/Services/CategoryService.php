<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function list()
    {
        return auth()->user()->categories;
    }

    public function create(array $data)
    {
        return auth()->user()->categories()->create($data);
    }

    public function update(Category $category, array $data)
    {
        return $category->update($data);
    }
}
