<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User;

use Webmozart\Assert\Assert;

class Email{
    private $value;

    public function __construct(string $value){
        Assert::notEmpty($value);
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)){
            throw new \InvalidArgumentException('Неверный формат почты.');
        }
        $this->value = mb_strtolower($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

}
