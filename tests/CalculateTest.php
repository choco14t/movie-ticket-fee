<?php
declare(strict_types=1);

namespace Tests;

use Carbon\Carbon;
use MovieTicketFee\Domain\Age;
use MovieTicketFee\Domain\Movie;
use MovieTicketFee\Domain\Regular;
use MovieTicketFee\Domain\ShowTime;
use MovieTicketFee\UseCases\Calculate;
use PHPUnit\Framework\TestCase;

class CalculateTest extends TestCase
{
    /**
     * @param Movie $movie
     * @param int $expected
     * @dataProvider dataProvider_一般観覧客の料金が計算できること
     */
    public function test_一般観覧客の料金が計算できること(Movie $movie, int $expected)
    {
        $customer = new Regular(new Age(35));
        $calculate = new Calculate();
        $actual = $calculate->run($customer, $movie);

        $this->assertEquals($expected, $actual->amount());
    }

    public function dataProvider_一般観覧客の料金が計算できること()
    {
        return [
            '通常上映' => [
                new Movie(new ShowTime(Carbon::create(2019, 7, 20, 10, 0, 0))),
                1800
            ],
            'レイトショー' => [
                new Movie(new ShowTime(Carbon::create(2019, 7, 20, 20, 0, 0))),
                1300
            ],
            '映画の日' => [
                new Movie(new ShowTime(Carbon::create(2019, 7, 1, 20, 0, 0))),
                1100
            ],
        ];
    }
}
