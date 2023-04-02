<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('products')->insert([
            'name' => Str::random(5),
            'description' => Str::random(5),
            'slug' => Str::random(5),
            'price' => '100',
            'discount' => '10',
            'category_id' => '1',
            'image' => 'https://picsum.photos/100/200',
            'stock' => '10',
            'author_id' => '1',
        ]);
    }
}