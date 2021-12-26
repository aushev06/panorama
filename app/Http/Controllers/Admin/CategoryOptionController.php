<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Options\CategoryOptionRequest;
use App\Models\Option\OptionCategory;
use Illuminate\Http\Request;

class CategoryOptionController extends Controller
{

    /**
     * @var OptionCategory
     */
    private $model;

    public function __construct(OptionCategory $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->model::paginate(20);

        return view('admin.option-categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.option-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryOptionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryOptionRequest $request)
    {
        $model = $this->save($request);

        return redirect()->route('option-categories.show', $model->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->model::findOrFail($id);

        return view('admin.option-categories.show', ['category' => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->model::findOrFail($id);

        return view('admin.option-categories.edit', ['category' => $model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryOptionRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryOptionRequest $request, $id)
    {
        $this->model = $this->model::findOrFail($id);
        $model       = $this->save($request);

        return redirect()->route('option-categories', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model::findOrFail($id)->delete();
        return redirect()->route('option-categories.index');
    }


    private function save(CategoryOptionRequest $request)
    {
        $this->model->fill(
            $request->all([
                OptionCategory::ATTR_STATUS,
                OptionCategory::ATTR_NAME,
                OptionCategory::ATTR_MAX_COUNT,
                OptionCategory::ATTR_REQUIRED,
                OptionCategory::ATTR_MAX_SELECTED,
                OptionCategory::ATTR_MIN_SELECTED,
            ])
        );
        $this->model->save();
        return $this->model;
    }
}
