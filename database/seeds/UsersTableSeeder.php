<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\User::insert([
            [
              'id'  			=> 1,
              'name'  			=> 'Kepala Pesantren',
              'username'		=> 'kapes123',
              'email' 			=> 'kapes123@pesantren.com',
              'password'		=> bcrypt('kapes123'),
              'gambar'			=> NULL,
              'level'			=> 'admin',
              'remember_token'	=> NULL,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 2,
              'name'  			=> 'Bendahara Pesantren',
              'username'		=> 'bendahara1',
              'email' 			=> 'bendahara1@pesantren.com',
              'password'		=> bcrypt('bendahara1'),
              'gambar'			=> NULL,
              'level'			=> 'user',
              'remember_token'	=> NULL,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}
