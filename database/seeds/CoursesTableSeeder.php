<?php
/**
 * Created by PhpStorm.
 * User: EP
 * Date: 5/20/2015
 * Time: 2:31 PM
 */

namespace database\seeds;


use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder{

    public function run() {
        DB::table('courses')->delete();
        \App\Course::create([

        ]);
    }
}