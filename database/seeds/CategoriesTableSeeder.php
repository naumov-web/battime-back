<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'id' => 1,
                'name' => 'Город'
            ],
            [
                'id' => 2,
                'name' => 'Мир'
            ],
            [
                'id' => 3,
                'name' => 'Страна'
            ],
            [
                'id' => 4,
                'name' => 'Дон'
            ],
        ];
        foreach($items as $item) {
            Category::create($item);
        }
    }
}
