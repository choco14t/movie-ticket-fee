<?php

namespace MovieTicketFee\Movie\Specification;

use MovieTicketFee\Customer\CustomerType;
use MovieTicketFee\Movie\MovieFee;
use MovieTicketFee\Movie\ShowTime;

interface MovieFeeSpecificationInterface
{
    public function satisfied(CustomerType $customerType): bool;

    public function fee(ShowTime $showTime): MovieFee;
}
