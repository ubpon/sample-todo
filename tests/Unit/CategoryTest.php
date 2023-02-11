<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\User;
use App\Services\CategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_category()
    {
        $categoryService = new CategoryService();

        $category = $categoryService->create(
            [
                'name' => 'sample category',
                'active' => 1,
            ]
        );

        $this->assertEquals('sample category', $category->name);
    }

    public function test_it_can_update_a_category()
    {
        $category = Category::factory()->state(['user_id' => auth()->id()])->create();

        $categoryService = new CategoryService();

        $categoryService->update(
            $category,
            [
                'name' => 'sample category',
                'active' => 1,
            ]
        );

        $this->assertEquals('sample category', $category->fresh()->name);
    }
}
