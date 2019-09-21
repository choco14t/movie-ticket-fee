<?php
declare(strict_types=1);

namespace MovieTicketFee\Customer;

class Customer
{
    /** @var Age */
    private $age;

    /** @var Belongings */
    private $belongings;

    public function __construct(Age $age, Belongings $belongings)
    {
        $this->age = $age;
        $this->belongings = $belongings;
    }

    public function age(): Age
    {
        return (clone $this->age);
    }

    public function belongings(): Belongings
    {
        return $this->belongings;
    }
}
