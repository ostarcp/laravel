<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Category;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
       

        $bookCate = Category::where('cate_name','book')->first();
        $penCate = Category::where('cate_name','pencil')->first();
        $boxCate = Category::where('cate_name','box')->first();

        $pd1 = Product::create([
            'name' => 'Lord of the rings',
            'cate_id' => $bookCate->id,
            'image' => 'uploads/default-image.jpg',
            'price'=> 500,
            'amount'=>5,
            'tt'=> 'OK'
        ]);

        $pd2 = Product::create([
            'name' => 'Lord of the Pens',
            'cate_id' => $penCate->id,
            'image' => 'uploads/default-image.jpg',
            'price'=> 500,
            'amount'=>5,
            'tt'=> 'OK'
        ]);

        $pd3 = Product::create([
            'name' => 'Lord of the Boxes',
            'cate_id' => $bookCate->id,
            'image' => 'uploads/default-image.jpg',
            'price'=> 500,
            'amount'=>5,
            'tt'=> 'OK'
        ]);

    }
}
