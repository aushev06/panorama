<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Categories\CategoryRequest;
use App\Http\Requests\CategoryAddRules;
use App\Models\Category\Category;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    private $categoryService;
    /**
     * @var Category
     */
    private $model;

    public function __construct(CategoryService $categoryService, Category $model)
    {
        $this->categoryService = $categoryService;
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::query()
            ->whereNull('parent_id')
            ->orderBy('id')
            ->paginate(15);

        return view('admin.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('childCategories')
            ->select(['id', 'name', 'parent_id'])
            ->whereNull('parent_id')
            ->get();

        return view('admin.category.create', ['categories' => $categories]);
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categoryService->save($request);
        return redirect()->route('categories.show',  $category->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->model::findOrFail($id);

        return view('admin.category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->model::findOrFail($id);
        $categories = Category::with('childCategories')
            ->select(['id', 'name', 'parent_id'])
            ->whereNull('parent_id')
            ->get();

        return view('admin.category.edit', [
            'category' => $category,
            'categories' => $categories
        ]);
    }


    /**
     * @param CategoryRequest $request
     * @param $id
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->categoryService->edit($id, $request);

        return redirect()->route('categories.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model::find($id)->delete();

        return redirect()->route('categories.index');
    }
}
