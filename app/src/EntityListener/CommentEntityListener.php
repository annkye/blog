<?php

declare(strict_types=1);

namespace App\EntityListener;

use App\Entity\User;
use App\Entity\Comment;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Symfony\Bundle\SecurityBundle\Security;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Comment::class)]
class CommentEntityListener
{
    public function __construct(private readonly Security $security)
    {
    }
    public function prePersist(Comment $comment, PrePersistEventArgs $event): void
    {
        $comment->setCreatedAt(new \DateTimeImmutable());
            $user = $this->security->getUser();
            $comment->setAuthor($user);
    }
}