<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Filters\FoodFilter;
use App\Models\Category\Category;
use App\Models\Food\Food;
use App\Models\Food\models\FoodViewModel;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Food\FoodReadRepository;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * @var FoodReadRepository
     */
    private $foodReadRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * FoodController constructor.
     * @param FoodReadRepository $foodReadRepository
     */
    public function __construct(FoodReadRepository $foodReadRepository, CategoryRepository $categoryRepository)
    {
        $this->foodReadRepository = $foodReadRepository;
        $this->categoryRepository = $categoryRepository;
    }


    public function index(Request $request, FoodFilter $filter)
    {
        $foods =
            $this->foodReadRepository
                ->get()->filter($filter)
                ->orderBy('category_id', 'asc')
                ->paginate(15);
        $breadcumb = 'Все блюда';

        $model = [];

        foreach ($foods as $food) {
            $model[] = new FoodViewModel($food);
        }


        return view('food.index', ['model' => $model, 'foods' => $foods, 'breadcumb' => $breadcumb]);
    }

    public function byCategorySlug(string $slug, FoodFilter $filter)
    {
        $category = $this->categoryRepository->findBySlug($slug);
        $foods    =
            $this->foodReadRepository
                ->get()->filter($filter)
                ->where(Food::ATTR_CATEGORY_ID, $category->id)
                ->paginate(15);

        $model = [];

        foreach ($foods as $food) {
            $model[] = new FoodViewModel($food);
        }

        $breadcumb = $category->name;

        return view('food.index',
            ['model' => $model, 'foods' => $foods, 'category' => $category, 'breadcumb' => $breadcumb]);
    }

    public function bySearch(FoodFilter $filter)
    {
        $foods = $this->foodReadRepository->get()->filter($filter)->paginate(9);

        $model = [];

        foreach ($foods as $food) {
            $model[] = new FoodViewModel($food);
        }

        return view('food.index', ['model' => $model, 'foods' => $foods, 'breadcumb' => "Поиск"]);
    }

    public function byId(Request $request, $id)
    {
        $model = new FoodViewModel($this->foodReadRepository->byId($id));
        return $request->get('show') ? view('food.api.quicview', compact('model')) : $model;
    }


}
