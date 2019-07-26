<?php

namespace MovieTicketFee;

class Member implements ViewingCustomer
{
    private const SENIOR_AGE = 60;

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
