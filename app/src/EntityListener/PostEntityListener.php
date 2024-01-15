<?php

declare(strict_types=1);

namespace App\EntityListener;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Bundle\SecurityBundle\Security;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: post::class)]
class PostEntityListener
{
    public function __construct(private readonly Security $security)
    {

    }

    public function prePersist(Post $post, PrePersistEventArgs $event): void
    {
        $entity=$event->getObject();
        $entity->setCreatedAt(new \DateTimeImmutable());
        $entity->setAuthor($this->security->getUser());
    }
}