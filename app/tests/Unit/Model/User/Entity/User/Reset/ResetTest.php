<?php

declare(strict_types=1);

namespace App\Tests\Unit\Model\User\Entity\User\Reset;

use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\ResetToken;
use App\Model\User\Entity\User\User;
use App\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;

class ResetTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = (new UserBuilder())->confirmed()->build();

        $now = new \DateTimeImmutable();
        $token = new ResetToken('token', $now->modify('+1 day'));

        $user->requestPasswordReset($token, $now);

        self::assertNotNull($user->getResetToken());

        $user->passwordReset($now, $hash = 'hash');

        self::assertNull($user->getResetToken());
        self::assertEquals($hash, $user->getPasswordHash());
    }

    public function testExpiredToken(): void
    {
        $user = (new UserBuilder())->confirmed()->build();

        $now = new \DateTimeImmutable();
        $token = new ResetToken('token', $now);

        $user->requestPasswordReset($token, $now);

        $this->expectExceptionMessage('Сброс пароля истёк.');
        $user->passwordReset($now->modify('+1 day'), 'hash');
    }

    public function testNotRequested(): void
    {
        $user = (new UserBuilder())->confirmed()->build();

        $now = new \DateTimeImmutable();

        $this->expectExceptionMessage('Сброс пароля не запрошен.');
        $user->passwordReset($now, 'hash');
    }
}