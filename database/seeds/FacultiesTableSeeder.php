<?php

use Illuminate\Database\Seeder;

class FacultiesTableSeeder extends Seeder {

    public function run() {
        DB::table('users')->delete();
        \App\Faculty::create([
            'name' => 'Engineering',
            'code' => 'ENG',
        ]);
        \App\Faculty::create([
            'name' => 'Social Sciences',
            'code' => 'SOC',
        ]);
    }
}