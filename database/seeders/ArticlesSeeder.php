<?php

namespace Database\Seeders;

use App\Models\Articles;
use App\Models\ArticleComment;
use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Articles::factory()->count(10)
        ->has(ArticleComment::factory()->count(3), 'comments')
        ->create();
    }
}
