<?php

namespace App\Helpers;


class MenuHelper
{
    public const CATEGORY_SECTIONS = [
        'yangiliklar' => '',
        'loyihalar' => '',
        'boshqarma' => ''
    ];

    public const PAGE_SECTIONS = [
        'boshqarma' => '',
        'loyihalar' => '',
        'korruptsiya' => '',
        'muassasalar' => ''
    ];

    public static function categorySections() : array
    {
        return self::CATEGORY_SECTIONS;
    }

    public static function pageSections() : array
    {
        return self::PAGE_SECTIONS;
    }
}
