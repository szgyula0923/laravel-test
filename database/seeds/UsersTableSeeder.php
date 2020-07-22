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
        factory(App\User::class,20)->create();
        factory(App\Contact::class,500)->create();


        /*DB::table('users')->insert([    'first_name'=>'Gyula',
                                        'last_name'=>'Szabó',
                                        'phone'=>'+36301848365',
                                        'fb_link'=>'facebook.com/me',
                                        'password'=>Hash::make('password'),
                                        'email'=>'admin@restapi.test',
                                        'birth_date'=>'1992-09-23',
                                        'active'=>true,
                                        'admin'=>true]);

        DB::table('users')->insert([    'first_name'=>'Péter',
                                        'last_name'=>'Sima',
                                        'phone'=>'+36301234567',
                                        'fb_link'=>'facebook.com/me',
                                        'password'=>Hash::make('password'),
                                        'email'=>'user1@restapi.test',
                                        'birth_date'=>'1995-05-12',
                                        'active'=>true,
                                        'admin'=>false]);

        DB::table('users')->insert([    'first_name'=>'Piroska',
                                        'last_name'=>'Kiss',
                                        'phone'=>'+36301234567',
                                        'fb_link'=>'facebook.com/me',
                                        'password'=>Hash::make('password'),
                                        'email'=>'user2@restapi.test',
                                        'birth_date'=>'1985-07-17',
                                        'active'=>false,
                                        'admin'=>false]);*/
    }
}
