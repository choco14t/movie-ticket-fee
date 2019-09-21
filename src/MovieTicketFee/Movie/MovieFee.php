<?php
declare(strict_types=1);

namespace MovieTicketFee\Movie;

use InvalidArgumentException;

class MovieFee
{
    /** @var int */
    private $amount;

    public function __construct(int $amount)
    {
        $this->setAmount($amount);
    }

    public function amount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    private function setAmount(int $amount): void
    {
        if ($amount < 0) {
            throw new InvalidArgumentException('Invalid Fee.');
        }

        $this->amount = $amount;
    }
}
