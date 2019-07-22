<?php
declare(strict_types=1);

namespace MovieTicketFee\Domain;

class Movie
{
    /** @var ShowTime */
    private $showTime;

    public function __construct(ShowTime $showTime)
    {
        $this->showTime = $showTime;
    }

    public function lateShow(): bool
    {
        return $this->showTime->late();
    }

    public function showTime(): ShowTime
    {
        return clone($this->showTime);
    }
}
