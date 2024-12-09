<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Category::create([
        'name'=>'HTML',
        'slug'=>"html"
       ]);
       Category::create([
        'name'=>'CSS',
        'slug'=>"css"
       ]);
       Category::create([
        'name'=>'JS',
        'slug'=>"js"
       ]);
       Category::create([
        'name'=>'PHP',
        'slug'=>"php"
       ]);
    }
}
