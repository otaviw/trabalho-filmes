<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Ação',
            'Comédia',
            'Drama',
            'Fantasia',
            'Ficção Científica',
            'Terror',
            'Romance',
            'Documentário',
            'Animação',
            'Suspense',
            'Crime',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
