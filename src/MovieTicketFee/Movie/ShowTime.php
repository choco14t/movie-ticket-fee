<?php
declare(strict_types=1);

namespace MovieTicketFee\Movie;

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

    public function lateShow(): bool
    {
        return $this->dateTime->hour >= 20;
    }

    public function weekDay(): bool
    {
        return $this->dateTime->isWeekday();
    }

    public function weekEnd(): bool
    {
        return $this->dateTime->isWeekend();
    }
}
