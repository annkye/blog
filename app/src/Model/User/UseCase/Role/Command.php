<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\Role;

use App\Model\User\Entity\User\User;
use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $role;

}
