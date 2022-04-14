<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

use App\Repository\CategoryRebository;
use App\Repository\PostRebository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    protected $categoryRepository;
    public function __construct(Request $request)
    {
            $this->data = $request->all();
            $this->categoryRepository = new CategoryRebository();
    }
    public function updateCategoryView()
    {
        $categories = $this->categoryRepository->getTreeArray();
        return view("CreateAdmin.create_category",["categories"=>$categories]);
    }

    public function updateCategoryPost()
    {
        $result = $this->categoryRepository->updateCategory($this->data["data"]);
        return view("List.list-parent-category",["categories"=>$result]);
    }
    public function deleteCategory(){
        $category = Category::find($this->data["category_id"])->delete();
        $categories = $this->categoryRepository->getTreeArray();
        return view("List.list-parent-category",["categories"=>$categories]);
    }
    public function createCategory(){
        $result = $this->categoryRepository->createCategory($this->data);
        $categories = $this->categoryRepository->getTreeArray();
        return view("List.list-parent-category",["categories"=>$categories]);
    }
}
