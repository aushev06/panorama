<?php
declare(strict_types=1);

namespace App\Widgets\Breadcumb\models;


/**
 * Элемент бредкрамба
 *
 * @author Ibra Aushev <aushevibra@yandex.ru>
 */
class Breadcumb
{
    /** @var string Заголовок. */
    public $label;

    /** @var string|null Ссылка. */
    public $link;

    /**
     * @var string|null Иконка
     */
    public $icon;

    /**
     * @param string $label
     * @param string|null $link
     * @param string|null $icon
     *
     * @return Breadcumb
     *
     * @author Ibra Aushev <aushevibra@yandex.ru>
     */
    public static function create(string $label, ?string $link = null, ?string $icon = null): Breadcumb
    {
        $breadcrumb        = new static;
        $breadcrumb->label = $label;
        $breadcrumb->link  = $link;
        $breadcrumb->icon  = $icon;

        return $breadcrumb;
    }
}
