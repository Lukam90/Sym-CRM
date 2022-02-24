<?php

namespace App\DataFixtures;

use DateTime;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $file = fopen(__DIR__ . "/csv/users.csv", "r");

        fgets($file); // 1st line

        while (! feof($file)) {
            $line = fgets($file);
            $line = str_replace("\n", "", $line);

            $cols = explode(";", $line);

            $user = new User;
            $user->setFullName($cols[0]);
            $user->setEmail($cols[1]);

            $password = $this->encoder->encodePassword($user, $cols[2]);

            $user->setPassword($password);

            $role = $cols[3];

            $user->setRoles(["ROLE_$role"]);

            $manager->persist($user);
            $manager->flush();
        }

        fclose($file);
    }
}
