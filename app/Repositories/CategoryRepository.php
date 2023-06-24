<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category as ModelsCategory;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function all(): string
    {
        // return ModelsCategory::all();
        return 'repository';
    }
}
