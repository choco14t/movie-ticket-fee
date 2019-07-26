<?php

namespace MovieTicketFee;

interface Calculator
{
    public function exec(ViewingCustomer $customer, ShowTime $showTime): Fee;
}
