<?php

namespace App\DataFixtures;

use DateTime;

use App\Entity\Event;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EventFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $file = fopen(__DIR__ . "/csv/events.csv", "r");

        fgets($file); // 1st line

        while (! feof($file)) {
            $line = fgets($file);
            $line = str_replace("\n", "", $line);

            $cols = explode(";", $line);

            $event = new Event;
            $event->setTitle($cols[0]);
            $event->setType($cols[1]);
            $event->setDate(new DateTime($cols[2]));
            $event->setDescription($cols[3]);

            $manager->persist($event);
            $manager->flush();
        }

        fclose($file);
    }
}
