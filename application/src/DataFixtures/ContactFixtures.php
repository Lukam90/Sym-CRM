<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $file = fopen(__DIR__ . "/csv/contacts.csv", "r");

        fgets($file); // 1st line

        while (! feof($file)) {
            $line = fgets($file);
            $line = str_replace("\n", "", $line);

            $cols = explode(";", $line);

            $contact = new Contact;
            $contact->setFullName($cols[0]);
            $contact->setType($cols[1]);
            $contact->setRole($cols[2]);
            $contact->setAddress($cols[3]);
            $contact->setPhone($cols[4]);
            $contact->setEmail($cols[5]);
            $contact->setWebsite($cols[6]);

            $manager->persist($contact);
            $manager->flush();
        }

        fclose($file);
    }
}
