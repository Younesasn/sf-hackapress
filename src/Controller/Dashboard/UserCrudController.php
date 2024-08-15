<?php

namespace App\Controller\Dashboard;

use App\Controller\Dashboard\Trait\DisableNewTrait;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    use DisableNewTrait;
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('civility'),
            TextField::new('firstName'),
            TextField::new('lastName'),
            TextField::new('username'),
            TextField::new('address'),
            ArrayField::new('roles'),
        ];
    }
    
}
