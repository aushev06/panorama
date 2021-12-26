<?php
/**
 * Created by PhpStorm.
 * User: aushev
 * Date: 02.09.2019
 * Time: 22:26
 */

namespace App\Repositories\Category;


use App\Models\Category\Category;
use App\Models\Food\Food;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryRepository
{
    public function get()
    {
        return Cache::remember(__CLASS__ . __METHOD__, 5000, function () {
            $categories = Category::get()->where('status', 1);
            return $categories;
        });
    }

    public function findBySlug(string $slug): ?Category
    {
        $category = Category::where([Category::ATTR_SLUG => $slug])->where([Category::ATTR_STATUS, 1])->first();

        if (null === $category) {
            throw new NotFoundHttpException("Данная категория не найдена");
        }

        return $category;
    }

    public function builder()
    {

        return Category::with('foods.options')->with('childCategories')->whereNull('parent_id')->where('status', 1);

    }

    public function byId($id)
    {
        return Cache::remember(__CLASS__ . __METHOD__ . $id, 5000, function () use ($id) {
            return Category::find($id);
        });
    }
}
