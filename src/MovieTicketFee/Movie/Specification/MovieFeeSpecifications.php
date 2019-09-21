<?php
declare(strict_types=1);

namespace MovieTicketFee\Movie\Specification;

use MovieTicketFee\Customer\Customer;
use MovieTicketFee\Customer\Specification\CustomerSpecifications;
use MovieTicketFee\Movie\MovieFee;
use MovieTicketFee\Movie\ShowTime;

class MovieFeeSpecifications
{
    /** @var CustomerSpecifications */
    private $customerSpecifications;

    /** @var MovieFeeSpecificationInterface[] */
    private $movieSpecifications;

    public function __construct()
    {
        $this->customerSpecifications = new CustomerSpecifications();
        $this->addMovieSpecifications();
    }

    public function satisfiedFee(Customer $customer, ShowTime $showTime): MovieFee
    {
        $customerType = $this->customerSpecifications->satisfiedType(
            $customer->age(),
            $customer->belongings()
        );

        foreach ($this->movieSpecifications as $movieSpecification) {
            if ($movieSpecification->satisfied($customerType)) {
                return $movieSpecification->fee($showTime);
            }
        }

        return new MovieFee(1800);
    }

    private function addMovieSpecifications()
    {
        $this->movieSpecifications = [
            new MemberMovieFeeSpecification(),
            new SeniorMemberMovieFeeSpecification(),
            new RegularMovieFeeSpecification(),
        ];
    }
}
