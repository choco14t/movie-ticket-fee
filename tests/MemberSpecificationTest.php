<?php

namespace Tests;

use MovieTicketFee\Customer\Age;
use MovieTicketFee\Customer\Belongings;
use MovieTicketFee\Customer\Specification\MemberSpecification;
use PHPUnit\Framework\TestCase;

class MemberSpecificationTest extends TestCase
{
    /**
     * @param Age $age
     * @param Belongings $belongings
     * @param bool $expected
     * @dataProvider dataProvider_会員の仕様を満たしているか判別できること
     */
    public function test_会員の仕様を満たしているか判別できること(Age $age, Belongings $belongings, bool $expected)
    {
        $spec = new MemberSpecification();
        $this->assertEquals($expected, $spec->satisfied($age, $belongings));
    }

    public function dataProvider_会員の仕様を満たしているか判別できること()
    {
        return [
            '会員である' => [new Age(20), Belongings::MEMBER_CARD(), true],
            '会員でない（シニア）' => [new Age(60), Belongings::MEMBER_CARD(), false],
            '会員でない' => [new Age(20), Belongings::NONE(), false],
        ];
    }
}
