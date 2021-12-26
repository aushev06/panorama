<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Options\OptionRequest;
use App\Models\Option\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{

    /**
     * @var Option
     */
    private $model;

    public function __construct(Option $model)
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
        $options = Option::paginate(20);
        return $this->view('index', ['options' => $options]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OptionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OptionRequest $request)
    {
        $this->save($request);

        return redirect()->route('options.show', $this->model->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->view('show', ['option' => $this->model::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->view('edit', ['option' => $this->model::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OptionRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(OptionRequest $request, $id)
    {
        $this->model = $this->model::findOrFail($id);
        $this->save($request);

        return redirect()->route('options.show', $id);
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

        return redirect()->route('options.index');
    }


    private function view(string $name, array $data = [])
    {
        return view('admin.options.' . $name, $data);
    }

    /**
     * @param OptionRequest $request
     * @return Option
     */
    private function save(OptionRequest $request)
    {
        $this->model->fill(
            $request->all([
                Option::ATTR_NAME,
                Option::ATTR_PRICE,
                Option::ATTR_OPTION_CATEGORY_ID,
                Option::ATTR_STATUS,
                Option::ATTR_MULTIPLIER,
            ])
        );

        $this->model->save();

        return $this->model;
    }
}
