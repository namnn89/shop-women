<?php

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Brand::class, 10)->create()->each(function ($b) {
            $b->products()->saveMany(factory(App\Models\Product::class, 2)->make());
        });
    }
}
