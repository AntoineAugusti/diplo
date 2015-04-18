<?php

use Diplo\Joueurs\Joueur;
use Diplo\Parties\PartiesRepository;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class JoueursTableSeeder extends Seeder
{
    /**
     * @var \Diplo\Parties\PartiesRepository
     */
    private $partiesRepo;

    public function __construct(PartiesRepository $partiesRepo)
    {
        $this->partiesRepo = $partiesRepo;
    }

    /**
     * Crée des joueurs dans la table associée.
     */
    public function run()
    {
        $this->command->info('Suppression des joueurs existantes...');
        Joueur::truncate();

        $faker = Faker::create();

        $this->command->info('Création des joueurs...');
        foreach (range(1, 1) as $partieId) {
            foreach (range(1, 3) as $joueurId) {
                $this->partiesRepo->rejoindre($partieId);
            }
        }
    }
}
