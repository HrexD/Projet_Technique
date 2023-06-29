<?php

namespace App\EventSubscriber;

use App\Entity\Tools;
use Doctrine\ORM\Events;
use App\Entity\BookingEntry;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;

class BookingEntrySubscriber implements EventSubscriber
{
    public function __construct(
        private EntityManagerInterface $manager,
        
    ) {}

    public function getSubscribedEvents(): array
    {
        return [
            Events::onFlush,
            Events::postFlush,
        ];
    }

    private array $reservation = [];

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

        foreach ($uow->getScheduledEntityDeletions() as $entity) {
            if ($entity instanceof BookingEntry) {
                $entry = $entity;
                
                $tools = $entry->getTools();

                $tools->setQuantity($tools->getQuantity() + 1);

                $this->reservation[] = $entry->getBooking();
                
                $uow->recomputeSingleEntityChangeSet($this->manager->getClassMetadata(Tools::class), $tools);
            }
        }
    }

    public function postFlush(PostFlushEventArgs $eventArgs): void 
    {
        if (!empty($this->reservation)) {
            foreach ($this->reservation as $booking) {
                if ($booking->getBookingEntries()->isEmpty()) {
                    $booking->setEndDate(new \DateTimeImmutable());
                    $this->manager->persist($booking);
                }
            }

            $this->reservation = [];
            $this->manager->flush();
        }
    }
}
