<?php

namespace App\EventListener;

use App\Entity\Order;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Symfony\Component\Security\Core\Security;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;

#[AsDoctrineListener(Events::prePersist)]
class AddUserToOrderListener
{
    public function __construct(private Security $security) {}

    public function prePersist(PrePersistEventArgs $event): void
    {
        $entity = $event->getObject();

        if (!$entity instanceof Order) {
            return;
        }

        $entity->setCustomer($this->security->getUser());
    }
}