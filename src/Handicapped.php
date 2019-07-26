<?php

namespace MovieTicketFee;

class Handicapped implements ViewingCustomer
{
    private const UNDER_HIGH_SCHOOL = 18;

    /** @var Age */
    private $age;

    public function __construct(Age $age)
    {
        $this->age = $age;
    }

    public function underHighSchool(): bool
    {
        return $this->age->value() < self::UNDER_HIGH_SCHOOL;
    }
}
