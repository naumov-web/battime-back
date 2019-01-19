<?php

use Illuminate\Database\Seeder;
use App\BannerPlace;

class BannerPlacesSeeder extends Seeder
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
                'name' => 'Верхняя часть страницы'
            ],
            [
                'id' => 2,
                'name' => 'Правая часть страницы'
            ]
        ];
        foreach($items as $item) {
            BannerPlace::create($item);
        }
    }
}
