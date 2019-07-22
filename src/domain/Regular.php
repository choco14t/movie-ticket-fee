<?php
declare(strict_types=1);

namespace MovieTicketFee\Domain;

class Regular implements ViewingCustomer
{
    private const SENIOR_AGE = 70;

    /** @var Age */
    private $age;

    public function __construct(Age $age)
    {
        $this->age = $age;
    }

    public function senior()
    {
        return $this->age->value() >= self::SENIOR_AGE;
    }
}
