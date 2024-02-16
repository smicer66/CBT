<?php
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: EP
 * Date: 5/19/2015
 * Time: 10:28 PM
 */

class RolesSeeder extends Seeder{


    public function run() {
        DB::table('roles')->delete();
        \App\Role::create([
            'name' => 'administrator',
            'display_name' => 'Administrator',
            'description'     => 'Oversees other roles',
        ]);

        \App\Role::create([
            'name' => 'examiner',
            'display_name' => 'Examiner',
            'description'     => 'Controls Examinations',
        ]);

        \App\Role::create([
            'name' => 'student',
            'display_name' => 'Student',
            'description'     => 'Takes examination',
        ]);
    }
}