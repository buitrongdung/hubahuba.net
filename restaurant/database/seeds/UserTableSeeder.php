<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            array(
                'name' => 'admin',
                'email' => 'admin@saritasa.com',
                'password' => \Hash::make('123456'),
                'level' => 1
            ),
            array(
                'name' => 'admin',
                'email' => 'admin@saritasa.com',
                'password' => \Hash::make('123456'),
                'level' => 2
            ),
            array(
                'name' => 'admin',
                'email' => 'admin@saritasa.com',
                'password' => \Hash::make('123456'),
                'level' => 3
            ),
            array(
                'email' => 'admin@saritasa.com',
                'password' => \Hash::make('123456'),
                'level' => 4
            ),
            array(
                'level' => 0,
                'username' => 'retyurtrytuy',
                'password' => \Hash::make('12345678')
            )
        ]);
    }

}
