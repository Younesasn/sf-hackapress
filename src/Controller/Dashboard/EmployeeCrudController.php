<?php

namespace App\Controller\Dashboard;

use App\Entity\Employee;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EmployeeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Employee::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('category', 'Poste'),
            AssociationField::new('civility'),
            TextField::new('lastName'),
            TextField::new('firstName'),
            TextField::new('username'),
            TextField::new('password')->hideOnIndex(),
            TextField::new('address'),
            ArrayField::new('roles')->hideOnIndex(),
        ];
    }
}
