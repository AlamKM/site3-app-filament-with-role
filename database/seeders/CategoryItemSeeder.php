<?php

namespace Database\Seeders;

use App\Models\CategoryItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryItem::create([
            'category' => 'Raw Material',
        ]);
        CategoryItem::create([
            'category' => 'Packaging Material',
        ]);
    }
}
