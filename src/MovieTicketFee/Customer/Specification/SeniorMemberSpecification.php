<?php
declare(strict_types=1);

namespace MovieTicketFee\Customer\Specification;

use MovieTicketFee\Customer\Age;
use MovieTicketFee\Customer\Belongings;
use MovieTicketFee\Customer\CustomerType;

class SeniorMemberSpecification implements CustomerSpecificationInterface
{
    public function satisfied(Age $age, Belongings $belongings): bool
    {
        return $this->isSenior($age) && $this->hasMemberCard($belongings);
    }

    public function type(): CustomerType
    {
        return CustomerType::SENIOR_MEMBER();
    }

    private function isSenior(Age $age): bool
    {
        return $age->value() >= 60;
    }

    private function hasMemberCard(Belongings $belongings)
    {
        return $belongings->equals(Belongings::MEMBER_CARD());
    }
}
