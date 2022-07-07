<?php

namespace App\Helpers;


class MenuHelper
{
    public const CATEGORY_SECTIONS = [
        'yangiliklar' => '',
        'loyihalar' => '',
        'boshqarma' => ''
    ];

    public static function categorySections() : array
    {
        return self::CATEGORY_SECTIONS;
    }
}
