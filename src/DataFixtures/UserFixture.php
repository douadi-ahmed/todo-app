<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('test@example.com');
        $user->setRoles(['ROLE_USER']); // Optionnel : getRoles() l'ajoute déjà

        // Hashage du mot de passe
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'motdepasse' // Remplacez par le mot de passe souhaité
        );
        $user->setPassword($hashedPassword);

        $manager->persist($user);
        $manager->flush();

        // Ajoutez d'autres utilisateurs si besoin...
    }
}