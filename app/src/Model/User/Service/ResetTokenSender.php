<?php

declare(strict_types=1);

namespace App\Model\User\Service;

interface ResetTokenSender
{
    public function send(Email $email, ResetToken $token): void;
}