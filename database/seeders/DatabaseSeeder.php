<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            "name" => "KyawZin",
            "email" => "kyawzin@gmail.com",
        ]);

        User::factory()->create([
            "name" => "MgPyaePhyo",
            "email" => "pyaephyo@gmail.com",
        ]);

        // \App\Models\User::factory(10)->create();
        Article::factory()->count(10)->create();
        //Category::factory()->count(5)->create();
        Comment::factory()->count(20)->create();

        $category = ["News", "Tech", "Mobile", "Computer", "General"];
        foreach ($category as $name) {
            \App\Models\Category::create(["name" => $name]);
        }
    }
}
