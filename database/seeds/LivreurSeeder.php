<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LivreurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            DB::table('livreurs')->insert([
                'id' => $i,
                'name' => Str::random(30),
                'prenom' => Str::random(8),
                'email' => Str::random(10),
                'password' => Hash::make('p@$$word123!!'),
            ]);

        }   
    }
}
