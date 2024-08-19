<?php

namespace App\Controller\Dashboard;

use App\Controller\Dashboard\Trait\DisableNewTrait;
use App\Entity\Item;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class ItemCrudController extends AbstractCrudController
{
    // use DisableNewTrait;
    public static function getEntityFqcn(): string
    {
        return Item::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $actions->disable(Action::NEW)->add(Crud::PAGE_INDEX, Action::DETAIL);
        return $actions;
    }

    public function configureFields(string $pageName): iterable
    {   
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('command', 'Order')->hideOnForm(),
            AssociationField::new('service')->hideOnForm(),
            AssociationField::new('product')->hideOnForm(),
            AssociationField::new('matter')->hideOnForm(),
            NumberField::new('quantity')->hideOnForm(),
            AssociationField::new('status'),
            AssociationField::new('employee'),
        ];
    }
}
