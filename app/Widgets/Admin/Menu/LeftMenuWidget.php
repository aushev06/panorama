<?php

namespace App\Widgets\Admin\Menu;

use App\Models\Category\Category;
use Arrilot\Widgets\AbstractWidget;

class LeftMenuWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $foodCategories = Category::get();

        return view('widgets.admin.menu.left_menu_widget', [
            'items' => $foodCategories,
        ]);
    }
}
