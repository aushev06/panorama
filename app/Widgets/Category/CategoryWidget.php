<?php

namespace App\Widgets\Category;

use App\Repositories\Category\CategoryRepository;
use Arrilot\Widgets\AbstractWidget;

class CategoryWidget extends AbstractWidget
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(array $config = [], CategoryRepository $categoryRepository)
    {
        parent::__construct($config);
        $this->categoryRepository = $categoryRepository;
    }

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
        $categories = $this->categoryRepository->get();

        return view('widgets.category.category_widget', [
            'config'     => $this->config,
            'categories' => $categories
        ]);
    }
}
