<?php

namespace App\Widgets\Breadcumb;

use Arrilot\Widgets\AbstractWidget;

class BreadcumbWidget extends AbstractWidget
{

    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [

    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        return view('widgets.breadcumb.breadcumb_widget', [
            'items' => $this->config['items'],
        ]);
    }
}
