<?php

/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 9/15/2016
 * Time: 10:51 AM
 */
class CategoriesProductsSitesSeeder extends DatabaseSeeder
{
    public function run()
    {
        factory(App\Models\Category::class, 50)->create()->each(function ($category) {
            $category->products()->save(factory(App\Models\Product::class)->make());
        });
        factory(App\Models\Site::class, 5000)->create()->each(function ($site) {
            $site->crawler()->save(factory(App\Models\Crawler::class)->make());
        });
    }
}