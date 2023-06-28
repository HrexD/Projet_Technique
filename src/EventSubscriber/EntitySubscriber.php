<?php

namespace App\EventSubscriber;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;

#[
    AsDoctrineListener(event: Events::prePersist)
]
class EntitySubscriber
{
    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if (
            method_exists($entity, 'setStartDate')
            && method_exists($entity, 'getStartDate')
            && null === $entity->getStartDate()
        ) {
            $entity->setStartDate(new \DateTimeImmutable());
        }
    }
}