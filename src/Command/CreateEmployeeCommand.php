<?php

namespace App\Command;

use App\Entity\Employee;
use App\Repository\CivilityRepository;
use App\Repository\ServiceCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-employee',
    description: 'Create an Employee user in the database',
)]
class CreateEmployeeCommand extends Command
{
    public function __construct(private EntityManagerInterface $em, private CivilityRepository $civilityRepository, private ServiceCategoryRepository $ServiceCategoryRepository)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('Civility', InputArgument::REQUIRED, 'Employee civility')
            ->addArgument('Username', InputArgument::REQUIRED, 'Employee username')
            ->addArgument('Password', InputArgument::REQUIRED, 'Employee password')
            ->addArgument('Category', InputArgument::REQUIRED, 'Employee category')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $employee = new Employee();
        $employee
            ->setCategory($this->ServiceCategoryRepository->findOneByName($input->getArgument('Category')))
            ->setCivility($this->civilityRepository->findOneByWording($input->getArgument('Civility')))
            ->setFirstName('Employee')
            ->setLastName('Employee')
            ->setUsername($input->getArgument('Username'))
            ->setPassword($input->getArgument('Password'))
            ->setRoles(['ROLE_EMPLOYEE'])
            ->setAddress('123 Rue Principale Bureau 500 75001 Paris');

        $this->em->persist($employee);
        $this->em->flush();

        $io->success('Employee user successfully created');

        return Command::SUCCESS;
    }
}
