<?php

namespace MovieTicketFee\Movie\Specification;

use MovieTicketFee\Customer\CustomerType;
use MovieTicketFee\Movie\MovieFee;
use MovieTicketFee\Movie\ShowTime;

class RegularMovieFeeSpecification implements MovieFeeSpecificationInterface
{
    public function satisfied(CustomerType $customerType): bool
    {
        return $customerType->equals(CustomerType::REGULAR());
    }

    public function fee(ShowTime $showTime): MovieFee
    {
        if ($showTime->movieDay()) {
            return new MovieFee(1100);
        }

        if ($showTime->lateShow()) {
            return new MovieFee(1300);
        }

        return new MovieFee(1800);
    }
}
