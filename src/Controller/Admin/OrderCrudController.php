<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Trait\DisableNewTrait;
use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class OrderCrudController extends AbstractCrudController
{
    use DisableNewTrait;
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('customer'),
            AssociationField::new('payment'),
            DateField::new('date'),
            NumberField::new('totalPrice'),
            ArrayField::new('items'),
        ];
    }
}
