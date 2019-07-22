<?php
declare(strict_types=1);

namespace MovieTicketFee\Domain;

use Carbon\Carbon;

class ShowTime
{
    private const MOVIE_DAY = 1;

    /** @var Carbon */
    private $dateTime;

    public function __construct(Carbon $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public function movieDay(): bool
    {
        return $this->dateTime->day === self::MOVIE_DAY;
    }

    public function late(): bool
    {
        return $this->dateTime->hour >= 20;
    }
}
