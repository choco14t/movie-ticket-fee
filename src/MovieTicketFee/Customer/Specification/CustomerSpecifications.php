<?php
declare(strict_types=1);

namespace MovieTicketFee\Customer\Specification;

use MovieTicketFee\Customer\Age;
use MovieTicketFee\Customer\Belongings;
use MovieTicketFee\Customer\CustomerType;

class CustomerSpecifications
{
    /** @var CustomerSpecificationInterface[] */
    private $specifications;

    public function __construct()
    {
        $this->addSpecifications();
    }

    public function satisfiedType(Age $age, Belongings $belongings): CustomerType
    {
        foreach ($this->specifications as $specification) {
            if ($specification->satisfied($age, $belongings)) {
                return $specification->type();
            }
        }

        return CustomerType::REGULAR();
    }

    private function addSpecifications()
    {
        $this->specifications = [
            new MemberSpecification(),
            new SeniorMemberSpecification(),
        ];
    }
}
