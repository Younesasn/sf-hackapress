<?php

namespace App\Controller\Dashboard;

use App\Entity\Item;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use Symfony\Component\Security\Core\Security;

class ItemCrudController extends AbstractCrudController
{
    public function __construct(private Security $security)
    {
    }

    public static function getEntityFqcn(): string
    {
        return Item::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->disable(Action::NEW )->add(Crud::PAGE_INDEX, Action::DETAIL);
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
            AssociationField::new('employee')->setPermission('ROLE_ADMIN'),
        ];
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

        // Filtrer les items en fonction de l'employé connecté
        if ($this->isGranted('ROLE_EMPLOYEE')) {
            $user = $this->security->getUser();
            $qb->andWhere('entity.employee = :employee')
                ->setParameter('employee', $user);
        }

        return $qb;
    }
}
