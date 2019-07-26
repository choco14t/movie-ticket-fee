<?php

namespace MovieTicketFee;

class StudentCalculator implements Calculator
{
    /**
     * @param ViewingCustomer|Student $customer
     * @param ShowTime $showTime
     * @return Fee
     */
    public function exec(ViewingCustomer $customer, ShowTime $showTime): Fee
    {
        if ($customer->underHighSchool()) {
            return new Fee(1000);
        }

        if ($showTime->movieDay()) {
            return new Fee(1100);
        }

        if ($showTime->lateShow()) {
            return $this->lateShowFee();
        }

        return $this->regularFee();

    }

    private function lateShowFee(): Fee
    {
        return new Fee(1300);
    }

    private function regularFee(): Fee
    {
        return new Fee(1500);
    }
}
