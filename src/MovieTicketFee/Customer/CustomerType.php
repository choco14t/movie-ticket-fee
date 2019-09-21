<?php

namespace MovieTicketFee\Customer;

use MyCLabs\Enum\Enum;

/**
 * 顧客種別
 *
 * @method static self MEMBER()
 * @method static self SENIOR_MEMBER()
 * @method static self REGULAR()
 */
class CustomerType extends Enum
{
    private const MEMBER = 'member';
    private const SENIOR_MEMBER = 'senior_member';
    private const REGULAR = 'regular';
}
