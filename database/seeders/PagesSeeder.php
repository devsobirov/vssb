<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = $this->getItems();
        DB::table('pages')->insert($pages);
    }

    private function getItems(): array
    {
        return [
            //boshqarma
            [
                'title' => json_encode([
                    'uz' => 'Nizom',
                    'ru' => 'Перечень'
                ]),
                'body' => json_encode(['uz' => '']),
                'location' => 'boshqarma',
                'author_id' => 1,
                'published' => true,
            ],
            [
                'title' => json_encode([
                    'uz' => 'Tuzilma',
                    'ru' => 'Структура'
                ]),
                'body' => json_encode(['uz' => '']),
                'location' => 'boshqarma',
                'author_id' => 1,
                'published' => true,
            ],
            [
                'title' => json_encode([
                    'uz' => 'Umumiy ma\'lumotlar',
                    'ru' => 'Общие сведения'
                ]),
                'body' => json_encode(['uz' => '']),
                'location' => 'boshqarma',
                'author_id' => 1,
                'published' => true,
            ],
            // Muassasa
            [
                'title' => json_encode([
                    'uz' => 'Viloyat muassasalar',
                    'ru' => 'Региональные учреждения'
                ]),
                'body' => json_encode(['uz' => '']),
                'location' => 'muassasalar',
                'author_id' => 1,
                'published' => true,
            ],
            [
                'title' => json_encode([
                    'uz' => 'Quyi tashkilotlar',
                    'ru' => 'Подчиненные организации'
                ]),
                'body' => json_encode(['uz' => '']),
                'location' => 'muassasalar',
                'author_id' => 1,
                'published' => true,
            ],
            [
                'title' => json_encode([
                    'uz' => 'Respublika filiallari',
                    'ru' => 'Республиканские филиалы'
                ]),
                'body' => json_encode(['uz' => '']),
                'location' => 'muassasalar',
                'author_id' => 1,
                'published' => true,
            ],

            // Loyihalar
            [
                'title' => json_encode([
                    'uz' => 'Davlat dasturlari',
                    'ru' => 'Государственные программы'
                ]),
                'body' => json_encode(['uz' => '']),
                'location' => 'loyihalar',
                'author_id' => 1,
                'published' => true,
            ],
            [
                'title' => json_encode([
                    'uz' => 'Innovatsion loyihalar',
                    'ru' => 'Инновационные проекты'
                ]),
                'body' => json_encode(['uz' => '']),
                'location' => 'loyihalar',
                'author_id' => 1,
                'published' => true,
            ],
            [
                'title' => json_encode([
                    'uz' => 'Xalq tibbiyoti',
                    'ru' => 'Народная медицина'
                ]),
                'body' => json_encode(['uz' => '']),
                'location' => 'loyihalar',
                'author_id' => 1,
                'published' => true,
            ],
            [
                'title' => json_encode([
                    'uz' => 'Tibbiy turizm',
                    'ru' => 'Медицинский туризм'
                ]),
                'body' => json_encode(['uz' => '']),
                'location' => 'loyihalar',
                'author_id' => 1,
                'published' => true,
            ],
            [
                'title' => json_encode([
                    'uz' => 'Davlat-xususiy sherikchilik',
                    'ru' => 'Государственно-частное партнерство'
                ]),
                'body' => json_encode(['uz' => '']),
                'location' => 'loyihalar',
                'author_id' => 1,
                'published' => true,
            ],
        ];
    }
}
