<?php

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
        $users = factory('App\User', 10)->create();
        $tracks = factory('App\Track', 10)->create();

        foreach ($users as $user){
            $tracks_ids = [];
            $tracks_ids[] = \App\Track::all()->random()->id;
            $tracks_ids[] = \App\Track::all()->random()->id;
            $user->tracks()->sync($tracks_ids);
        }

        $tracks = factory('App\Course', 50)->create();

        foreach ($users as $user){
            $course_ids = [];

            $course_ids[] = \App\Course::all()->random()->id;
            $course_ids[] = \App\Course::all()->random()->id;
            $course_ids[] = \App\Course::all()->random()->id;

            $user->courses()->sync($course_ids);
        }
        factory('App\Course', 50)->create();
        factory('App\Video', 100)->create();

        $quizzes = factory('App\Quiz', 100)->create();
        foreach ($users as $user){
            $quizzes_ids = [];

            $quizzes_ids[] = \App\Quiz::all()->random()->id;
            $quizzes_ids[] = \App\Quiz::all()->random()->id;
            $quizzes_ids[] = \App\Quiz::all()->random()->id;

            $user->quizzes()->sync($quizzes_ids);
        }
        factory('App\Question', 200)->create();
        factory('App\Photo', 50)->create();
    }
}
