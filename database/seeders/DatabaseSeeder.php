<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory()
            ->times(5)
            ->create()
            ->each(function ($u){

                $u->questions()->saveMany(
                    Question::factory()->times(rand(1,5))->make()
                )->each(function ($q){

                    $q->answers()->saveMany(
                        Answer::factory()->times(rand(1,8))->make()
                    );

                });
            });
    }
}
