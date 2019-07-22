<?php
declare(strict_types=1);

namespace MovieTicketFee\UseCases;

use MovieTicketFee\Domain\Fee;
use MovieTicketFee\Domain\Movie;
use MovieTicketFee\Domain\ViewingCustomer;

class Calculate
{
    public function run(ViewingCustomer $customer, Movie $movie): Fee
    {
        if ($movie->showTime()->movieDay()) {
            return new Fee(1100);
        }

        return $movie->lateShow() ? new Fee(1300) : new Fee(1800);
    }
}
