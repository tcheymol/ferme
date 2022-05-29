<?php

namespace App\Services;

use App\Entity\User;
use App\Security\Authenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class UserService
{
    private EntityManagerInterface $em;
    private AuthenticationUtils $authenticationUtils;
    private UserPasswordHasherInterface $hasher;
    private UserAuthenticatorInterface $authenticator;
    private Authenticator $formAuthenticator;

    public function __construct(
        EntityManagerInterface      $em,
        AuthenticationUtils         $authenticationUtils,
        UserPasswordHasherInterface $hasher,
        UserAuthenticatorInterface  $authenticator,
        Authenticator               $formAuthenticator
    ) {
        $this->em = $em;
        $this->authenticationUtils = $authenticationUtils;
        $this->hasher = $hasher;
        $this->authenticator = $authenticator;
        $this->formAuthenticator = $formAuthenticator;
    }

    public function createUser(User $user): void
    {
        $user->setPassword($this->hasher->hashPassword($user, $user->getPassword()));
        $this->em->persist($user);
        $this->em->flush();
    }

    public function createUserAndLogin(User $user, Request $request): ?Response
    {
        $this->createUser($user);

        return $this->authenticator->authenticateUser(
            $user,
            $this->formAuthenticator,
            $request
        );
    }

    public function getLastUsername(): string
    {
        return $this->authenticationUtils->getLastUsername();
    }
}