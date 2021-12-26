<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Ingridient\IngridientRequest;
use App\Models\Ingridient\Ingridient;
use App\Models\Ingridient\IngridientFoods;
use App\Models\Category\Category;
use App\Models\Food\Food;
use App\Repositories\Category\CategoryRepository;
use App\Services\Ingridient\IngridientService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IngridientController extends Controller
{

    const TITLE = "Ингридиенты";


    const ROUTE_INDEX         = 'ingridients.index';
    const ROUTE_CREATE        = 'ingridients.create';
    const ROUTE_SHOW          = 'ingridients.show';
    const ROUTE_STORE         = 'ingridients.store';
    const ROUTE_UPDATE        = 'ingridients.update';
    const ROUTE_EDIT          = 'ingridients.edit';
    const ROUTE_DESTROY       = 'ingridients.destroy';
    const ROUTE_UPDATE_STATUS = 'ingridients.update-status';
    /**
     * @var IngridientService
     */
    private $ingridientService;

    public function __construct(IngridientService $ingridientService)
    {
        $this->ingridientService = $ingridientService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Ingridient::paginate(15);

        return view('admin.ingridient.index', [
            'ingridients' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryRepository $categoryRepository)
    {
        $model = new Ingridient();
        $foods = $categoryRepository->builder()->get()->map(function (Category $item) use ($model) {
            return [
                'name'  => $item->name,
                'foods' => $item->foods->map(function (Food $food) use ($model) {
                    return [
                        'id'       => $food->id,
                        'name'     => $food->name,
                        'selected' => $model->id && $food->ingridients()->where([
                            [IngridientFoods::ATTR_FOOD_ID, $food->id],
                            [IngridientFoods::ATTR_INGRIDIENT_ID, $model->id]
                        ])->first() ? true : false
                    ];
                })
            ];
        });

        return view('admin.ingridient.create', [
            'model' => $model,
            'foods' => $foods
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(IngridientRequest $request)
    {

        $ingridient = $this->ingridientService->save($request, new Ingridient());

        return redirect()->route(self::ROUTE_SHOW, $ingridient->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ingridient = Ingridient::with('foods')->findOrFail($id);

        return view('admin.ingridient.show', [
            'model' => $ingridient
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryRepository $categoryRepository, $id)
    {
        $model = Ingridient::findOrFail($id);

        $foods = $categoryRepository->builder()->get()->map(function (Category $item) use ($model) {
            return [
                'name'  => $item->name,
                'foods' => $item->foods->map(function (Food $food) use ($model) {
                    return [
                        'id'       => $food->id,
                        'name'     => $food->name,
                        'selected' => $model->id && $food->ingridients()->where([
                            [IngridientFoods::ATTR_FOOD_ID, $food->id],
                            [IngridientFoods::ATTR_INGRIDIENT_ID, $model->id]
                        ])->first() ? true : false
                    ];
                })
            ];
        });


        return view('admin.ingridient.edit', [
            'model' => $model,
            'foods' => $foods
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(IngridientRequest $request, $id)
    {
        $ingridient = $this->ingridientService->save($request, Ingridient::findOrFail($id));

        return redirect()->route(self::ROUTE_SHOW, $ingridient->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ingridient::findOrFail($id)->delete();

        return redirect()->route(self::ROUTE_INDEX);
    }


    public function updateStatus(Request $request, $ingridientID, $foodID)
    {
        /**
         * @var IngridientFoods $model
         */
        $model = IngridientFoods::where([
            [IngridientFoods::ATTR_INGRIDIENT_ID, $ingridientID],
            [IngridientFoods::ATTR_FOOD_ID, $foodID],
        ])->firstOrFail();

        $model->status = $request->post('status');
        $model->save();
    }
}
