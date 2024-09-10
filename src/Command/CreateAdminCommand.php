<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\CivilityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-admin',
    description: 'Create an admin user in the database',
)]
class CreateAdminCommand extends Command
{
    public function __construct(private EntityManagerInterface $em, private CivilityRepository $civilityRepository)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('Civility', InputArgument::REQUIRED, 'Admin civility')
            ->addArgument('Username', InputArgument::REQUIRED, 'Admin username')
            ->addArgument('Password', InputArgument::REQUIRED, 'Admin password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $admin = new User();
        $admin
            ->setCivility($this->civilityRepository->findOneByWording($input->getArgument('Civility')))
            ->setFirstName('Admin')
            ->setLastName('Admin')
            ->setUsername($input->getArgument('Username'))
            ->setPassword($input->getArgument('Password'))
            ->setRoles(['ROLE_ADMIN'])
            ->setAddress('8 rue du Poisson 9876 Londres');

        $this->em->persist($admin);
        $this->em->flush();

        $io->success('Admin user successfully created');

        return Command::SUCCESS;
    }
}
