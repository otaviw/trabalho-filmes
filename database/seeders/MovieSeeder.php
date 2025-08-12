<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Category;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        $movies = [
            [
                'title' => 'Interestelar',
                'synopsis' => 'Uma equipe de exploradores viaja através de um buraco de minhoca no espaço na tentativa de garantir a sobrevivência da humanidade.',
                'year' => 2014,
                'category_id' => $categories->where('name', 'Ficção Científica')->first()->id,
                'trailer_link' => 'https://www.youtube.com/watch?v=2LqzF5WauAw',
                'cover_image' => 'covers/uel.jpg'
            ],
            [
                'title' => 'O Poderoso Chefão',
                'synopsis' => 'A história da família Corleone, uma das cinco famílias da máfia de Nova York, liderada por Vito Corleone.',
                'year' => 1972,
                'category_id' => $categories->where('name', 'Drama')->first()->id,
                'trailer_link' => 'https://www.youtube.com/watch?v=sY1S34973zA',
                'cover_image' => 'covers/mewtwo.jpg'
            ],
            [
                'title' => 'Pulp Fiction',
                'synopsis' => 'Várias histórias interconectadas de criminosos em Los Angeles, Califórnia.',
                'year' => 1994,
                'category_id' => $categories->where('name', 'Crime')->first()->id,
                'trailer_link' => 'https://www.youtube.com/watch?v=s7EdQ4FqbhY',
                'cover_image' => 'covers/uel.jpg'
            ],
            [
                'title' => 'O Senhor dos Anéis: A Sociedade do Anel',
                'synopsis' => 'Um hobbit recebe a missão de destruir um anel poderoso que pode destruir o mundo.',
                'year' => 2001,
                'category_id' => $categories->where('name', 'Fantasia')->first()->id,
                'trailer_link' => 'https://www.youtube.com/watch?v=V75dMMIW2B4',
                'cover_image' => 'covers/mewtwo.jpg'
            ],
            [
                'title' => 'Matrix',
                'synopsis' => 'Um programador descobre que a realidade como conhecemos é uma simulação criada por máquinas.',
                'year' => 1999,
                'category_id' => $categories->where('name', 'Ficção Científica')->first()->id,
                'trailer_link' => 'https://www.youtube.com/watch?v=m8e-FF8MsqU',
                'cover_image' => 'covers/uel.jpg'
            ],
            [
                'title' => 'Forrest Gump',
                'synopsis' => 'A história de um homem simples que viveu momentos extraordinários da história americana.',
                'year' => 1994,
                'category_id' => $categories->where('name', 'Drama')->first()->id,
                'trailer_link' => 'https://www.youtube.com/watch?v=bLvqoHBptjg',
                'cover_image' => 'covers/mewtwo.jpg'
            ],
            [
                'title' => 'O Rei Leão',
                'synopsis' => 'Simba, um jovem leão, deve enfrentar seu passado e assumir seu lugar como rei.',
                'year' => 1994,
                'category_id' => $categories->where('name', 'Animação')->first()->id,
                'trailer_link' => 'https://www.youtube.com/watch?v=4sj1MT05lAA',
                'cover_image' => 'covers/uel.jpg'
            ],
            [
                'title' => 'Titanic',
                'synopsis' => 'Uma história de amor entre um artista pobre e uma jovem rica a bordo do navio Titanic.',
                'year' => 1997,
                'category_id' => $categories->where('name', 'Romance')->first()->id,
                'trailer_link' => 'https://www.youtube.com/watch?v=2e-eXJ6HgkQ',
                'cover_image' => 'covers/mewtwo.jpg'
            ]
        ];

        foreach ($movies as $movieData) {
            Movie::create([
                'title' => $movieData['title'],
                'synopsis' => $movieData['synopsis'],
                'year' => $movieData['year'],
                'category_id' => $movieData['category_id'],
                'trailer_link' => $movieData['trailer_link'],
                'cover_image' => $movieData['cover_image'],
            ]);
        }
    }
}
