<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Category::truncate();

            Category::create(['cate_name' => 'book']);
            Category::create(['cate_name' => 'pencil']);
            Category::create(['cate_name' => 'box']);
         
    }
}
