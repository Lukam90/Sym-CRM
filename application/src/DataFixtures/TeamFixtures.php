<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TeamFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $file = fopen(__DIR__ . "/csv/teams.csv", "r");

        fgets($file); // 1st line

        while (! feof($file)) {
            $line = fgets($file);

            $team = new Team;
            $team->setName($line);

            $manager->persist($team);
            $manager->flush();
        }

        fclose($file);
    }
}