<?php

namespace Tests;

use MovieTicketFee\Customer\Age;
use MovieTicketFee\Customer\Belongings;
use MovieTicketFee\Customer\CustomerType;
use MovieTicketFee\Customer\Specification\CustomerSpecifications;
use PHPUnit\Framework\TestCase;

class CustomerSpecificationsTest extends TestCase
{
    /**
     * @param Age $age
     * @param Belongings $belongings
     * @param CustomerType $expected
     * @dataProvider dataProvider_条件を満たした顧客種別が取得できること
     */
    public function test_条件を満たした顧客種別が取得できること(Age $age, Belongings $belongings, CustomerType $expected)
    {
        $specs = new CustomerSpecifications();

        $this->assertEquals($expected, $specs->satisfiedType($age, $belongings));
    }

    public function dataProvider_条件を満たした顧客種別が取得できること()
    {
        return [
            '会員' => [new Age(59), Belongings::MEMBER_CARD(), CustomerType::MEMBER()],
            'シニア会員' => [new Age(60), Belongings::MEMBER_CARD(), CustomerType::SENIOR_MEMBER()],
            '一般' => [new Age(20), Belongings::NONE(), CustomerType::REGULAR()],
        ];
    }
}
