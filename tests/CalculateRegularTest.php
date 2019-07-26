<?php
declare(strict_types=1);

namespace Tests;

use Carbon\Carbon;
use MovieTicketFee\Age;
use MovieTicketFee\Regular;
use MovieTicketFee\RegularCalculator;
use MovieTicketFee\ShowTime;
use PHPUnit\Framework\TestCase;

class CalculateRegularTest extends TestCase
{
    /**
     * @param Regular $customer
     * @param ShowTime $showTime
     * @param int $expected
     * @dataProvider dataProvider_一般観覧客の料金が計算できること
     */
    public function test_一般観覧客の料金が計算できること(Regular $customer, ShowTime $showTime, int $expected)
    {
        $calculator = new RegularCalculator();
        $actual = $calculator->exec($customer, $showTime);

        $this->assertEquals($expected, $actual->amount());
    }

    public function dataProvider_一般観覧客の料金が計算できること()
    {
        return [
            '通常上映' => [
                new Regular(new Age(24)),
                new ShowTime(Carbon::create(2019, 7, 20, 10, 0, 0)),
                1800
            ],
            'レイトショー' => [
                new Regular(new Age(24)),
                new ShowTime(Carbon::create(2019, 7, 20, 20, 0, 0)),
                1300
            ],
            '映画の日' => [
                new Regular(new Age(24)),
                new ShowTime(Carbon::create(2019, 7, 1, 10, 0, 0)),
                1100
            ],
            '通常上映（シニア）' => [
                new Regular(new Age(70)),
                new ShowTime(Carbon::create(2019, 7, 20, 10, 0, 0)),
                1100
            ],
            'レイトショー（シニア）' => [
                new Regular(new Age(70)),
                new ShowTime(Carbon::create(2019, 7, 20, 20, 0, 0)),
                1100
            ],
            '映画の日（シニア）' => [
                new Regular(new Age(70)),
                new ShowTime(Carbon::create(2019, 7, 1, 10, 0, 0)),
                1100
            ],
        ];
    }
}
