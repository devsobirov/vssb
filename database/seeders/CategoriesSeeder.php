<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = $this->getItems();

        DB::table('categories')->insert($categories);
    }

    private function getItems() : array
    {
        return [
            // Yangiliklar
            [
                'name' => json_encode([
                    'uz' => 'Янгиликлар',
                    'ru' => 'Новости'
                ]),
                'slug' => 'yangiliklar',
                'location' => 'yangiliklar',
                'created_at' => now()
            ],
            // Boshqarma - xz, yo'q
            // Loyihalar
            [
                'name' => json_encode([
                    'uz' => 'Davlat haridlari',
                    'ru' => 'Покупки народа'
                ]),
                'slug' => 'davlat-haridlari',
                'location' => 'loyihalar',
                'created_at' => now()
            ],
            [
                'name' => json_encode([
                    'uz' => 'Tenderlar',
                    'ru' => 'Тендеры'
                ]),
                'slug' => 'tenderlar',
                'location' => 'loyihalar', // loyiha
                'created_at' => now()
            ],
            [
                'name' => json_encode([
                    'uz' => 'Tadbirlar',
                    'ru' => 'Мероприятия'
                ]),
                'slug' => 'tadbirlar',
                'location' => 'loyihalar',
                'created_at' => now()
            ],
            // Korruptsiya

            [
                'name' => json_encode([
                    'uz' => 'Tadbirlar',
                    'ru' => 'Мероприятия'
                ]),
                'slug' => 'ak-tadbirlar',
                'location' => 'korruptsiya',
                'created_at' => now()
            ],
        ];
    }
}
