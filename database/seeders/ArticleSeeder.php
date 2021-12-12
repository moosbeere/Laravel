<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Articles;
use App\Models\ArticleComment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Articles::factory()->count(10)->
        has(ArticleComment::factory()->count(3), 'comments')->create();
    }
}
