<?php

namespace Tests;

use Carbon\Carbon;
use MovieTicketFee\Age;
use MovieTicketFee\Member;
use MovieTicketFee\MemberCalculator;
use MovieTicketFee\ShowTime;
use PHPUnit\Framework\TestCase;

class CalculateMemberTest extends TestCase
{
    /**
     * @param Member $customer
     * @param ShowTime $showTime
     * @param int $expected
     * @dataProvider dataProvider_会員料金が計算できること
     */
    public function test_会員料金が計算できること(Member $customer, ShowTime $showTime, int $expected)
    {
        $calculator = new MemberCalculator();
        $actual = $calculator->exec($customer, $showTime);

        $this->assertEquals($expected, $actual->amount());
    }

    public function dataProvider_会員料金が計算できること()
    {
        return [
            '通常上映' => [
                new Member(new Age(24)),
                new ShowTime(Carbon::create(2019, 7, 26, 10, 0, 0)),
                1000
            ],
            'レイトショー' => [
                new Member(new Age(24)),
                new ShowTime(Carbon::create(2019, 7, 26, 20, 0, 0)),
                1000
            ],
            '通常上映（土日祝）' => [
                new Member(new Age(24)),
                new ShowTime(Carbon::create(2019, 7, 20, 10, 0, 0)),
                1300
            ],
            'レイトショー（土日祝）' => [
                new Member(new Age(24)),
                new ShowTime(Carbon::create(2019, 7, 20, 20, 0, 0)),
                1000
            ],
            '映画の日（平日）' => [
                new Member(new Age(24)),
                new ShowTime(Carbon::create(2019, 7, 1, 10, 0, 0)),
                1000
            ],
            '通常上映（映画の日, 土日祝）' => [
                new Member(new Age(24)),
                new ShowTime(Carbon::create(2019, 9, 1, 10, 0, 0)),
                1100
            ],
            'レイトショー（映画の日, 土日祝）' => [
                new Member(new Age(24)),
                new ShowTime(Carbon::create(2019, 9, 1, 20, 0, 0)),
                1000
            ],
            '通常上映（シニア）' => [
                new Member(new Age(60)),
                new ShowTime(Carbon::create(2019, 7, 20, 10, 0, 0)),
                1000
            ],
            'レイトショー（シニア）' => [
                new Member(new Age(60)),
                new ShowTime(Carbon::create(2019, 7, 20, 20, 0, 0)),
                1000
            ],
            '映画の日（シニア）' => [
                new Member(new Age(60)),
                new ShowTime(Carbon::create(2019, 7, 1, 10, 0, 0)),
                1000
            ],
        ];
    }
}
