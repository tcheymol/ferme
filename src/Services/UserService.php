<?php

namespace App\Services;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly Security $security,
        private readonly UserPasswordHasherInterface $hasher,
    ) {
    }

    public function createUser(User $user): void
    {
        $user->setPassword($this->hasher->hashPassword($user, $user->getPassword()));
        $this->em->persist($user);
        $this->em->flush();
    }

    public function createUserAndLogin(User $user): void
    {
        $this->createUser($user);
        $this->security->login($user);
    }
}
