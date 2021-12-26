<?php

namespace App\Http\Controllers\Admin;

use App\Filters\FoodFilter;
use App\Http\Requests\Foods\FoodRequest;
use App\Models\Category\Category;
use App\Models\Food\Food;
use App\Models\Food\FoodProperty;
use App\Models\Food\models\FoodViewModel;
use App\Models\Option\Option;
use App\Models\RecomendFood\RecomendFood;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Food\FoodReadRepository;
use App\Services\Food\FoodService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FoodController extends Controller
{

    const TITLE = "Блюда";


    const ROUTE_INDEX   = 'food.index';
    const ROUTE_CREATE  = 'food.create';
    const ROUTE_SHOW    = 'food.show';
    const ROUTE_STORE   = 'food.store';
    const ROUTE_UPDATE  = 'food.update';
    const ROUTE_EDIT    = 'food.edit';
    const ROUTE_DESTROY = 'food.destroy';

    /**
     * @var FoodService
     */
    private $foodService;
    /**
     * @var FoodReadRepository
     */
    private $foodReadRepository;
    /**
     * @var Food
     */
    private $model;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(
        FoodService $foodService,
        FoodReadRepository $foodReadRepository,
        Food $model,
        CategoryRepository $categoryRepository
    ) {
        $this->foodService        = $foodService;
        $this->foodReadRepository = $foodReadRepository;
        $this->model              = $model;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, FoodFilter $filter)
    {

        $foods = $this->foodReadRepository->get()->filter($filter)->paginate(15);

        $categoryName = $request->get('category') ? $this->categoryRepository->byId($request->get('category'))->name : null;

        return view('admin.food.index', compact('foods', 'categoryName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $variants   = Food::getStatusVariants();

        $foods   = Food::get()->map(function (Food $food) {
            return [
                'id'     => $food->id,
                'name'   => $food->name,
                'select' => false
            ];
        });
        $options = Option::where(Option::ATTR_STATUS, Option::STATUS_ACTIVE)->get()->keyBy('id')->map(function (
            Option $option
        ) {
            return [
                'id'     => $option->id,
                'name'   => $option->name,
                'select' => false
            ];
        });

        return view('admin.food.create', compact('categories', 'variants', 'foods', 'options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodRequest $request)
    {
        $food = $this->foodService->save($request);

        return redirect()->route('food.show', $food->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $food = Food::findOrFail($id);

        $model = new FoodViewModel($food);


        return view("admin.food.show", ['model' => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /**
         * @var Food $food
         */
        $food          = $this->model::with('options')->findOrFail($id);
        $foodOptions   = $food->options->keyBy('id');
        $model         = new FoodViewModel($food);
        $categories    = Category::get();
        $variants      = Food::getStatusVariants();
        $foodPropeties = $model->properties;
        $foods         = Food::get()->map(function (Food $food) use ($model) {

            return [
                'id'     => $food->id,
                'name'   => $food->name,
                'select' => $model->food->recomend()->where([
                    [RecomendFood::ATTR_FOOD_RECOMEND_ID, $food->id]
                ])->first() ? true : false
            ];
        });
        $options       = Option::where(Option::ATTR_STATUS, Option::STATUS_ACTIVE)->get()->keyBy('id')->map(function (
            Option $option
        ) use ($foodOptions) {
            return [
                'id'     => $option->id,
                'name'   => $option->name,
                'select' => isset($foodOptions[$option->id]) ? true : false,
            ];
        });

        return view('admin.food.edit', [
            'model'          => $food,
            'categories'     => $categories,
            'variants'       => $variants,
            'foodProperties' => $foodPropeties,
            'foods'          => $foods,
            'options'        => $options,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FoodRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(FoodRequest $request, $id)
    {
        $this->foodService->edit($request, $id);

        return redirect()->route(static::ROUTE_SHOW, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        if (!$food->delete()) {
            throw new \Exception("Не удалось удалить!");
        }

        return redirect()->route(static::ROUTE_INDEX);
    }
}
