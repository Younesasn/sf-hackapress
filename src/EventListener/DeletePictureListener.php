<?php

namespace App\EventListener;

use Doctrine\ORM\Events;
use Doctrine\ORM\Event\PreRemoveEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;

#[AsDoctrineListener(Events::preRemove)]
class DeletePictureListener
{
    public function __construct()
    {
    }

    public function preRemove(PreRemoveEventArgs $event): void 
    {
        $entity = $event->getObject();

        if (!$entity instanceof Product && !$entity instanceof Service) {
            return;
        }

        unlink('uploads/' . $entity->getPicture());
    }
}