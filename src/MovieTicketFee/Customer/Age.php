<?php
declare(strict_types=1);

namespace MovieTicketFee\Customer;

use InvalidArgumentException;

class Age
{
    private $value;

    public function __construct(int $value)
    {
        $this->setValue($value);
    }

    public function value(): int
    {
        return $this->value;
    }

    private function setValue(int $value)
    {
        if ($value < 0) {
            throw new InvalidArgumentException('Invalid age.');
        }

        $this->value = $value;
    }
}
