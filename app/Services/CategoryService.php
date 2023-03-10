<?php

namespace App\Services;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;

class CategoryService {
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategories() : Collection {
        return $this->categoryRepository->getCategories();
    }

    public function saveCategory(Request $request) : void {
        $validated = $request->validate([
            'name' => 'required|max:255'
        ]);

        $category = new Category();
        $category->name = $request->input("name");
        $category->state = 1;
        
        $this->categoryRepository->saveCategory($category);
    }

    public function getCategoryById(int $id) : Category {
        return $this->categoryRepository->getCategoryById($id);
    }

    public function updateCategorty(Request $request, int $id) : void {
        $validated = $request->validate([
            'name' => 'required|max:255'
        ]);

        $category = $this->categoryRepository->getCategoryById($id);
        $category->name = $request->name;

        $this->categoryRepository->updateCategorty($category);
    }

    public function changeStateCategory(int $id) : void {
        $category = $this->categoryRepository->getCategoryById($id);
        $category->state = ($category->state == 1) ?0 :1;

        $this->categoryRepository->updateCategorty($category);
    }

    public function getCategoriesByStateActive() : Collection {
        return $this->categoryRepository->getCategoriesByStateActive();
    }
}