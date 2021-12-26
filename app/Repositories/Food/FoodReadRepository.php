<?php
/**
 * Created by PhpStorm.
 * User: aushev
 * Date: 05.09.2019
 * Time: 21:44
 */

namespace App\Repositories\Food;


use App\Models\Food\Food;
use App\Models\Food\FoodProperty;
use App\Models\Food\models\FoodViewModel;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class FoodReadRepository
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * FoodReadRepository constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Возвращает билдер запроса
     *
     * @return Builder
     */
    public function get(): Builder
    {
        return Food::select([Food::TABLE_NAME . '.*']);
    }

    public function findByCategorySlug(string $slug): ?Builder
    {
        $category = $this->categoryRepository->findBySlug($slug);

        $foods = Food::where(Food::ATTR_CATEGORY_ID, $category->id);

        return $foods;
    }

    /**
     * @param $id
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function byId($id)
    {
        return $this->get()->findOrFail($id);
    }

    public function getRecomendsFromFoodPropertyId($foodPropertyId): ?array
    {
        $foodProperty = FoodProperty::with('food')->findOrFail($foodPropertyId);

        $food = $foodProperty->food;


        $recomends = [];
        foreach ($food->recomend()->get() as $item) {
            $recomends[] = new FoodViewModel($item);
        }

        return $recomends;
    }
}
