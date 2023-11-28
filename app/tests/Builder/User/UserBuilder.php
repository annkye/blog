<?php
declare(strict_types=1);

namespace App\Tests\Builder\User;

use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Name;
use App\Model\User\Entity\User\Role;
use App\Model\User\Entity\User\User;
use App\Model\User\Entity\User\Id;

class UserBuilder
{
    private $id;
    private $date;
    private $role;
    private $confirmed;

    public function __construct()
    {
        $this->id = Id::next();
        $this->date = new \DateTimeImmutable();
    }


    public function confirmed(): self
    {
        $clone = clone $this;
        $clone->confirmed = true;
        return $clone;
    }

    public function build(): User
    {
        $user = new User(
            Id::next(),
            new \DateTimeImmutable(),
            new Email('test@app.test'),
            'hash',
            $token = 'token'
        );

        if ($this->confirmed) {
            $user->confirmSignUp();
        }

        if ($this->role) {
            $user->changeRole($this->role);
        }

        return $user;
    }
}
