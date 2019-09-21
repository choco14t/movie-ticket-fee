<?php
declare(strict_types=1);

namespace MovieTicketFee\Customer\Specification;

use MovieTicketFee\Customer\Age;
use MovieTicketFee\Customer\Belongings;
use MovieTicketFee\Customer\CustomerType;

interface CustomerSpecificationInterface
{
    // TODO: 引数をCustomerにする
    public function satisfied(Age $age, Belongings $belongings): bool;

    public function type(): CustomerType;
}
