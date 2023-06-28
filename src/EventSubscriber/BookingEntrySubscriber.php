<?php

namespace App\EventSubscriber;

use App\Entity\BookingEntry;
use App\Entity\Tools;
use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\OnFlushEventArgs;

class BookingEntrySubscriber implements EventSubscriber
{
    public function __construct(
        private EntityManagerInterface $manager,
        
    ) {}

    public function getSubscribedEvents(): array
    {
        return [
            Events::onFlush
        ];
    }

    public function onFlush(OnFlushEventArgs $eventArgs): void
    {
        $uow = $this->manager->getUnitOfWork();

        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            if ($entity instanceof BookingEntry) {
                $entry = $entity;
                
                $tools = $entry->getTools();

                $tools->setQuantity($tools->getQuantity() - 1);
                
                $uow->recomputeSingleEntityChangeSet($this->manager->getClassMetadata(Tools::class), $tools);
            }
        }
    }
}
