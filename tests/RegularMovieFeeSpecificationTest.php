<?php

namespace Tests;

use Carbon\Carbon;
use MovieTicketFee\Customer\CustomerType;
use MovieTicketFee\Movie\MovieFee;
use MovieTicketFee\Movie\ShowTime;
use MovieTicketFee\Movie\Specification\RegularMovieFeeSpecification;
use PHPUnit\Framework\TestCase;

class RegularMovieFeeSpecificationTest extends TestCase
{
    /**
     * @param CustomerType $customerType
     * @param bool $expected
     * @dataProvider dataProvider_一般料金の条件を満たしているか判別できること
     */
    public function test_一般料金の条件を満たしているか判別できること(CustomerType $customerType, bool $expected)
    {
        $spec = new RegularMovieFeeSpecification();

        $this->assertEquals($expected, $spec->satisfied($customerType));
    }

    public function dataProvider_一般料金の条件を満たしているか判別できること()
    {
        return [
            '会員' => [CustomerType::MEMBER(), false],
            'シニア会員' => [CustomerType::SENIOR_MEMBER(), false],
            '一般' => [CustomerType::REGULAR(), true],
        ];
    }

    /**
     * @param ShowTime $showTime
     * @param MovieFee $expected
     * @dataProvider dataProvider_上映日時ごとの料金を取得できること
     */
    public function test_上映日時ごとの料金を取得できること(ShowTime $showTime, MovieFee $expected)
    {
        $spec = new RegularMovieFeeSpecification();

        $this->assertEquals($expected, $spec->fee($showTime));
    }

    public function dataProvider_上映日時ごとの料金を取得できること()
    {
        return [
            '平日' => [new ShowTime(new Carbon('2019-09-02 19:59:59')), new MovieFee(1800)],
            '平日レイトショー' => [new ShowTime(new Carbon('2019-09-02 20:00:00')), new MovieFee(1300)],
            '土日祝' => [new ShowTime(new Carbon('2019-09-15 10:00:00')), new MovieFee(1800)],
            '土日祝レイトショー' => [new ShowTime(new Carbon('2019-09-02 20:00:00')), new MovieFee(1300)],
            '映画の日' => [new ShowTime(new Carbon('2019-09-01 10:00:00')), new MovieFee(1100)],
        ];
    }
}
