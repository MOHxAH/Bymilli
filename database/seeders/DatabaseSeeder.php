<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */

     use WithoutModelEvents;

     public function run(): void
    {

        $this->call([
            FormSeeder::class,
            QuestionSeeder::class,
            FormQuestionSeeder::class,
        ]);
    }
}
