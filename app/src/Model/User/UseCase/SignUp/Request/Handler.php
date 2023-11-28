<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\SignUp\Request;


use App\Model\User\Entity\User\User;
use App\Model\User\Entity\Service;
use App\Model\User\Entity\User\UserRepository;

class Handler
{
    private $users;
    private $hasher;
    private $tokenizer;
    private $sender;
    private $flusher;

    public function __construct(
        UserRepository $users,
        PasswordHasher $hasher,
        ConfirmTokenizer $tokenizer,
        ConfirmTokenSender $sender,
        Flusher $flusher)
    {
        $this->users = $users;
        $this->hasher = $hasher;
        $this->tokenizer = $tokenizer;
        $this->sender = $sender;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        $email = new Email($command->email);

        if ($this->users->hasByEmail($email)){
            throw new \DomainException('Такой пользователь уже существует');
        }

        $user = new User(
            Id::next(),
            new \DateTimeImmutable(),
            $email,
            $this->hasher->hash($command->password),
            $token = $this->tokenizer->generate()
        );

        $this->users->add($user);
        $this->sender->send($email, $token);
        $this->flusher->flush();
    }
}