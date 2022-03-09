<?php

namespace App\DataFixtures;

use DateTime;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordHasherInterface
     */
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
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

            $password = $this->encoder->hashPassword($user, $cols[2]);

            $user->setPassword($password);

            $user->setRole($cols[3]);
            $user->setCreatedAt(new DateTime($cols[4]));

            $manager->persist($user);
            $manager->flush();
        }

        fclose($file);
    }
}
