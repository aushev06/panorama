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
        $this->model           = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy(Category::ATTR_ORDER)->paginate(15);

        return view('admin.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categoryService->save($request);
        return redirect()->route('categories.show', ['id' => $category->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.category.edit', ['category' => $this->model::findOrFail($id)]);
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model::find($id)->delete();

        return redirect()->route('categories.index');
    }

    public function setPosition(Request $request)
    {
        foreach ($request->post('blocks') ?? [] as $item) {
            $model        = $this->model::findOrFail($item['id']);
            $model->order = $item['position'];
            $model->save();
        }

    }
}
