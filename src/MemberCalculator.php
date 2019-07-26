<?php

namespace MovieTicketFee;

class MemberCalculator implements Calculator
{
    /**
     * @param ViewingCustomer|Member $customer
     * @param ShowTime $showTime
     * @return Fee
     */
    public function exec(ViewingCustomer $customer, ShowTime $showTime): Fee
    {
        if ($this->senior($customer)) {
            return $this->seniorFee();
        }

        if ($showTime->lateShow()) {
            return $this->lateShowFee();
        }

        return $this->regularFee($showTime);
    }

    /**
     * @param ViewingCustomer|Member $customer
     * @return bool
     */
    private function senior(ViewingCustomer $customer): bool
    {
        return $customer->senior();
    }

    private function regularFee(ShowTime $showTime): Fee
    {
        if ($showTime->weekEnd() && !$showTime->movieDay()) {
            return new Fee(1300);
        }

        if ($showTime->weekEnd() && $showTime->movieDay()) {
            return new Fee(1100);
        }

        return new Fee(1000);
    }

    private function lateShowFee(): Fee
    {
        return new Fee(1000);
    }

    private function seniorFee(): Fee
    {
        return new Fee(1000);
    }
}
