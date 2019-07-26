<?php

namespace MovieTicketFee;

class RegularCalculator implements Calculator
{
    /**
     * @param ViewingCustomer|Regular $customer
     * @param ShowTime $showTime
     * @return Fee
     */
    public function exec(ViewingCustomer $customer, ShowTime $showTime): Fee
    {
        if ($this->senior($customer)) {
            return $this->seniorFee();
        }

        return $this->regularFee($showTime);
    }

    /**
     * @param ViewingCustomer|Regular $customer
     * @return bool
     */
    private function senior(ViewingCustomer $customer): bool
    {
        return $customer->senior();
    }

    private function regularFee(ShowTime $showTime): Fee
    {
        if ($showTime->movieDay()) {
            return new Fee(1100);
        }

        if ($showTime->lateShow()) {
            return new Fee(1300);
        }

        return new Fee(1800);
    }

    private function seniorFee(): Fee
    {
        return new Fee(1100);
    }
}
