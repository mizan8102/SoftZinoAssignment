<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Repositories\Eloquent\Category\CategoryRepositoryInterface;


class CategoryService implements CategoryRepositoryInterface
{
    public function index()
    {
        return Category::all();
    }
}