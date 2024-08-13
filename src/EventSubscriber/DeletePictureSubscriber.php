<?php

namespace App\EventSubscriber;

use App\Entity\Product;
use App\Entity\Service;
use Doctrine\ORM\Event\PreRemoveEventArgs;
use Doctrine\ORM\Events;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;

class DeletePictureSubscriber implements EventSubscriberInterface
{
    public function __construct()
    {
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::preRemove,
        ];
    }

    public function preRemove(PreRemoveEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof Product && !$entity instanceof Service) {
            return;
        }

        unlink('uploads/' . $entity->getPicture());
    }
}