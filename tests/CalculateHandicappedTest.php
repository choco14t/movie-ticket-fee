<?php

namespace Tests;

use Carbon\Carbon;
use MovieTicketFee\Age;
use MovieTicketFee\Handicapped;
use MovieTicketFee\HandicappedCalculator;
use MovieTicketFee\ShowTime;
use PHPUnit\Framework\TestCase;

class CalculateHandicappedTest extends TestCase
{
    /**
     * @param Handicapped $customer
     * @param ShowTime $showTime
     * @param int $expected
     * @dataProvider dataProvider_料金計算できること
     */
    public function test_料金計算できること(Handicapped $customer, ShowTime $showTime, int $expected)
    {
        $calculator = new HandicappedCalculator();
        $actual = $calculator->exec($customer, $showTime);

        $this->assertEquals($expected, $actual->amount());
    }

    public function dataProvider_料金計算できること()
    {
        return [
            '高校生以下' => [
                new Handicapped(new Age(17)),
                new ShowTime(Carbon::create(2019, 7, 20, 10, 0, 0)),
                900
            ],
            '学生以上' => [
                new Handicapped(new Age(19)),
                new ShowTime(Carbon::create(2019, 7, 20, 20, 0, 0)),
                1000
            ],
        ];
    }
}
