<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category page
    public function index()
    {
        $category = Category::get();
        return view('admin.category.index', compact('category'));
    }

    //create category
    public function createCategory(Request $request)
    {
        $validator = $this->categoryValidationCheck($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $this->getCategoryData($request);
        Category::create($data);
        return back();
    }

    //delete category
    public function categoryDelete($id)
    {
        Category::where('category_id', $id)->delete();
        return redirect()->route('category')->with(['successDelete' => 'Category deleted successfully!']);
    }

    //search category
    public function searchCategory(Request $request)
    {
        $category = Category::where('title', 'LIKE', '%' . $request->categorySearch . '%')->get();
        return view('admin.category.index', compact('category'));
    }

    //direct edit category page
    public function editCategory($id)
    {
        $category = Category::get();
        $updateData = Category::where('category_id', $id)->first();
        return view('admin.category.edit', compact('category', 'updateData'));
    }

    //update category
    public function updateCategory($id, Request $request)
    {
        $validator = $this->categoryValidationCheck($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $updateData = $this->getUpdateCategoryData($request);
        Category::where('category_id', $id)->update($updateData);
        return redirect()->route('category');
    }

    //get update category data
    private function getUpdateCategoryData($request)
    {
        return [
            'title' => $request->title,
            'description' => $request->description
        ];
    }

    //get category data
    private function getCategoryData($request)
    {
        return [
            'title' => $request->title,
            'description' => $request->description
        ];
    }

    //category validation
    private function categoryValidationCheck($request)
    {
        return Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
        ]);
    }
}
