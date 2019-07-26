<?php

namespace MovieTicketFee;

class HandicappedCalculator implements Calculator
{
    /**
     * @param ViewingCustomer|Handicapped $customer
     * @param ShowTime $showTime
     * @return Fee
     */
    public function exec(ViewingCustomer $customer, ShowTime $showTime): Fee
    {
        if ($customer->underHighSchool()) {
            return new Fee(900);
        }

        return new Fee(1000);
    }
}
