<?php

namespace Tests;

use Carbon\Carbon;
use MovieTicketFee\Customer\Age;
use MovieTicketFee\Customer\Belongings;
use MovieTicketFee\Customer\Customer;
use MovieTicketFee\Movie\MovieFee;
use MovieTicketFee\Movie\ShowTime;
use MovieTicketFee\Movie\Specification\MovieFeeSpecifications;
use PHPUnit\Framework\TestCase;

class MovieFeeSpecificationsTest extends TestCase
{
    /**
     * @param Customer $customer
     * @param ShowTime $showTime
     * @param MovieFee $expected
     * @dataProvider dataProvider_会員の料金を取得できること
     */
    public function test_会員の料金を取得できること(Customer $customer, ShowTime $showTime, MovieFee $expected)
    {
        $specs = new MovieFeeSpecifications();

        $this->assertEquals($expected, $specs->satisfiedFee($customer, $showTime));
    }

    public function dataProvider_会員の料金を取得できること()
    {
        $customer = new Customer(new Age(20), Belongings::MEMBER_CARD());

        return [
            '平日' => [$customer, new ShowTime(new Carbon('2019-09-02 19:59:59')), new MovieFee(1000)],
            '平日レイトショー' => [$customer, new ShowTime(new Carbon('2019-09-02 20:00:00')), new MovieFee(1000)],
            '土日祝' => [$customer, new ShowTime(new Carbon('2019-09-15 10:00:00')), new MovieFee(1300)],
            '土日祝レイトショー' => [$customer, new ShowTime(new Carbon('2019-09-02 20:00:00')), new MovieFee(1000)],
            '映画の日' => [$customer, new ShowTime(new Carbon('2019-09-01 10:00:00')), new MovieFee(1100)],
        ];
    }

    /**
     * @param Customer $customer
     * @param ShowTime $showTime
     * @param MovieFee $expected
     * @dataProvider dataProvider_シニア会員の料金を取得できること
     */
    public function test_シニア会員の料金を取得できること(Customer $customer, ShowTime $showTime, MovieFee $expected)
    {
        $specs = new MovieFeeSpecifications();

        $this->assertEquals($expected, $specs->satisfiedFee($customer, $showTime));
    }

    public function dataProvider_シニア会員の料金を取得できること()
    {
        $customer = new Customer(new Age(60), Belongings::MEMBER_CARD());

        return [
            '平日' => [$customer, new ShowTime(new Carbon('2019-09-02 19:59:59')), new MovieFee(1000)],
            '平日レイトショー' => [$customer, new ShowTime(new Carbon('2019-09-02 20:00:00')), new MovieFee(1000)],
            '土日祝' => [$customer, new ShowTime(new Carbon('2019-09-15 10:00:00')), new MovieFee(1000)],
            '土日祝レイトショー' => [$customer, new ShowTime(new Carbon('2019-09-02 20:00:00')), new MovieFee(1000)],
            '映画の日' => [$customer, new ShowTime(new Carbon('2019-09-01 10:00:00')), new MovieFee(1000)],
        ];
    }

    /**
     * @param Customer $customer
     * @param ShowTime $showTime
     * @param MovieFee $expected
     * @dataProvider dataProvider_一般料金を取得できること
     */
    public function test_一般料金を取得できること(Customer $customer, ShowTime $showTime, MovieFee $expected)
    {
        $specs = new MovieFeeSpecifications();

        $this->assertEquals($expected, $specs->satisfiedFee($customer, $showTime));
    }

    public function dataProvider_一般料金を取得できること()
    {
        $customer = new Customer(new Age(70), Belongings::NONE());

        return [
            '平日' => [$customer, new ShowTime(new Carbon('2019-09-02 19:59:59')), new MovieFee(1800)],
            '平日レイトショー' => [$customer, new ShowTime(new Carbon('2019-09-02 20:00:00')), new MovieFee(1300)],
            '土日祝' => [$customer, new ShowTime(new Carbon('2019-09-15 10:00:00')), new MovieFee(1800)],
            '土日祝レイトショー' => [$customer, new ShowTime(new Carbon('2019-09-02 20:00:00')), new MovieFee(1300)],
            '映画の日' => [$customer, new ShowTime(new Carbon('2019-09-01 10:00:00')), new MovieFee(1100)],
        ];
    }
}
