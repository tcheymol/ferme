<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateAdminCommand extends Command
{
    protected static $defaultName = 'app:create-admin';
    protected static $defaultDescription = 'Creates an admin user';
    private EntityManagerInterface $em;
    private UserPasswordHasherInterface $hasher;

    public function __construct(
        EntityManagerInterface      $em,
        UserPasswordHasherInterface $hasher,
        string                      $name = null
    ) {
        parent::__construct($name);
        $this->em = $em;
        $this->hasher = $hasher;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('password', InputArgument::REQUIRED, 'Password');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $user = (new User())
            ->setEmail('admin@gmail.com')
            ->setRoles(['ROLE_ADMIN']);

        $user->setPassword($this->hasher->hashPassword($user, $input->getArgument('password')));

        try {
            $this->em->persist($user);
            $this->em->flush();
            $io->success('User successfully created');

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->error($e->getMessage());

            return Command::FAILURE;
        }
    }

}
