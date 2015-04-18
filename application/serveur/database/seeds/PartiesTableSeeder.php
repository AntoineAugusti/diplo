<?php

use Diplo\Parties\Partie;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PartiesTableSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('Suppression des parties existantes...');
        Partie::truncate();

        $faker = Faker::create();

        $this->command->info('Création des parties...');
        foreach (range(1, 1) as $index) {
            Partie::create([]);
        }
    }
}
