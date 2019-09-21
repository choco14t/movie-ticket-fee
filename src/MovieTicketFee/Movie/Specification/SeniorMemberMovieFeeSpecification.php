<?php

namespace MovieTicketFee\Movie\Specification;

use MovieTicketFee\Customer\CustomerType;
use MovieTicketFee\Movie\MovieFee;
use MovieTicketFee\Movie\ShowTime;

class SeniorMemberMovieFeeSpecification implements MovieFeeSpecificationInterface
{
    public function satisfied(CustomerType $customerType): bool
    {
        return $customerType->equals(CustomerType::SENIOR_MEMBER());
    }

    public function fee(ShowTime $showTime): MovieFee
    {
        return new MovieFee(1000);
    }
}
