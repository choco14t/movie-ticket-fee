<?php

namespace Tests;

use MovieTicketFee\Customer\Age;
use MovieTicketFee\Customer\Belongings;
use MovieTicketFee\Customer\Specification\SeniorMemberSpecification;
use PHPUnit\Framework\TestCase;

class SeniorMemberSpecificationTest extends TestCase
{
    /**
     * @param Age $age
     * @param Belongings $belongings
     * @param bool $expected
     * @dataProvider dataProvider_シニア会員の仕様を満たしているか判別できること
     */
    public function test_シニア会員の仕様を満たしているか判別できること(Age $age, Belongings $belongings, bool $expected)
    {
        $spec = new SeniorMemberSpecification();
        $this->assertEquals($expected, $spec->satisfied($age, $belongings));
    }

    public function dataProvider_シニア会員の仕様を満たしているか判別できること()
    {
        return [
            'シニア会員である' => [new Age(60), Belongings::MEMBER_CARD(), true],
            'シニア会員でない（会員証あり）' => [new Age(59), Belongings::MEMBER_CARD(), false],
            'シニア会員でない（会員証なし）' => [new Age(60), Belongings::NONE(), false],
        ];
    }
}
