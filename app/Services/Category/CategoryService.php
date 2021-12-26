<?php

declare(strict_types=1);

namespace App\Services\Category;

use App\Http\Requests\Categories\CategoryRequest;
use App\Models\Category\Category;

class CategoryService
{
    /**
     * @param CategoryRequest $request
     * @return Category
     */
    public function save(CategoryRequest $request): Category
    {
        $category = new Category();
        $category->fill($request->all(['name', 'description', 'parent_id', 'status']));

        if ($request->file('img')) {
            $category->img = $request->file('img')->store('categories', 'public');
        }

        if ($request->file('icon')) {
            $category->icon = $request->file('icon')->store('categories', 'public');
        }


        $category->save();

        return $category;
    }

    /**
     * @param $id
     * @param CategoryRequest $request
     * @return Category
     */
    public function edit($id, CategoryRequest $request): Category
    {
        $category = Category::findOrFail($id);
        $category->fill($request->all([
            Category::ATTR_NAME,
            Category::ATTR_DESCRIPTION,
            Category::ATTR_PARENT_ID,
            Category::ATTR_STATUS,
        ]));


        if ($request->file('img')) {
            $category->img = $request->file('img')->store('categories', 'public');
        }

        if ($request->file('icon')) {
            $category->icon = $request->file('icon')->store('categories', 'public');
        }

        $category->save();

        return $category;
    }
}
