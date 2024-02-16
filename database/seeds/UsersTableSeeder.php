<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder{

    public function run()
    {
        DB::table('users')->delete();
        \App\User::create([
            'first_name' => 'Michael',
            'last_name' => 'Obi',
            'identity_no'     => '11110000',
            'password'      => bcrypt('test'),
        ]);
        \App\User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'identity_no'     => '00001111',
            'password'      => bcrypt('test'),
        ]);

       \App\User::create([
           'first_name' => 'Richard',
           'last_name' => 'Roe',
           'identity_no'     => '11111111',
           'password'      => bcrypt('test'),
       ]);
       \App\User::create([
          'first_name' => 'Jane',
          'last_name' => 'Doe',
          'identity_no'     => '22222222',
          'password'      => bcrypt('test'),
      ]);
    }
}