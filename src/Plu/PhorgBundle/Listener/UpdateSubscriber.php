<?php
namespace Plu\PhorgBundle\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Persistence\Event\PreUpdateEventArgs;
use Plu\PhorgBundle\Entity\TrackModifications;

class UpdateSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return array(
            'preUpdate',
        );
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        echo 'sup;'; exit;
        $entity = $args->getObject();
        if ($entity instanceof TrackModifications) {
            $args->setNewValue("lastModification", new \DateTime());
        }

    }

}