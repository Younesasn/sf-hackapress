<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Trait\DisableNewTrait;
use App\Entity\Item;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ItemCrudController extends AbstractCrudController
{
    use DisableNewTrait;
    public static function getEntityFqcn(): string
    {
        return Item::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('command', 'Order'),
            AssociationField::new('product'),
            AssociationField::new('matter'),
            AssociationField::new('status'),
            AssociationField::new('service'),
        ];
    }
}
