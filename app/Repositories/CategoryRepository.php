<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;

class CategoryRepository {
    public function getCategories() : Collection {
        return Category::all();
    }

    public function saveCategory(Category $category) : void {
        $category->save();
    }

    public function getCategoryById(int $id) : Category {
        return Category::find($id);
    }

    public function updateCategorty(Category $category) : void {
        $category->update();
    }

    public function getCategoriesByStateActive() : Collection {
        return Category::where('state', 1)->get();
    }
}