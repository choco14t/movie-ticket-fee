<?php

namespace MovieTicketFee\Movie\Specification;

use MovieTicketFee\Customer\CustomerType;
use MovieTicketFee\Movie\MovieFee;
use MovieTicketFee\Movie\ShowTime;

class MemberMovieFeeSpecification implements MovieFeeSpecificationInterface
{
    public function satisfied(CustomerType $customerType): bool
    {
        return $customerType->equals(CustomerType::MEMBER());
    }

    public function fee(ShowTime $showTime): MovieFee
    {
        if ($showTime->weekDay() || $this->weekendLateShow($showTime)) {
            return new MovieFee(1000);
        }

        if ($showTime->movieDay()) {
            return new MovieFee(1100);
        }

        return new MovieFee(1300);
    }

    private function weekendLateShow(ShowTime $showTime)
    {
        return $showTime->weekEnd() && $showTime->lateShow();
    }
}
