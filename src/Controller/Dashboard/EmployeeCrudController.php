<?php

namespace App\Controller\Dashboard;

use App\Controller\Dashboard\Trait\DisableNewTrait;
use App\Entity\Employee;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EmployeeCrudController extends AbstractCrudController
{
    use DisableNewTrait;
    public static function getEntityFqcn(): string
    {
        return Employee::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('category', 'Poste'),
            AssociationField::new('civility'),
            TextField::new('lastName'),
            TextField::new('firstName'),
            TextField::new('username'),
            TextField::new('address'),
        ];
    }
}
