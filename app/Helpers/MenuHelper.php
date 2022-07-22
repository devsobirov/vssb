<?php

namespace App\Helpers;


class MenuHelper
{
    public const CATEGORY_SECTIONS = [
        'yangiliklar' => 'yangiliklar',
        'loyihalar' => 'loyihalar',
        'boshqarma' => 'boshqarma',
        'korruptsiya' => 'korruptsiya',
    ];

    public const PAGE_SECTIONS = [
        'boshqarma' => 'boshqarma',
        'korruptsiya' => 'korruptsiya',
        'muassasalar' => 'muassasalar',
        'loyihalar' => 'loyihalar'
    ];

    public const DOCUMENT_CATEGORIES = [
        '1' => 'buyruqlar',
        '2' => 'vss buyruqlari',
        '3' => 'boshqarma buyruqlari',
        '4' => 'boshqa hujjatlar'
    ];

    public static function categorySections() : array
    {
        return self::CATEGORY_SECTIONS;
    }

    public static function pageSections() : array
    {
        return self::PAGE_SECTIONS;
    }

    public static function docCategories() : array
    {
        return self::DOCUMENT_CATEGORIES;
    }

    public function getDocumentCategory($id): string
    {
        if (!empty($category = self::DOCUMENT_CATEGORIES[$id]))
        {
            return strtoupper($category);
        }
        return 'Not found';
    }
}
