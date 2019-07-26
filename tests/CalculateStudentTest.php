<?php

namespace Tests;

use Carbon\Carbon;
use MovieTicketFee\Age;
use MovieTicketFee\ShowTime;
use MovieTicketFee\Student;
use MovieTicketFee\StudentCalculator;
use PHPUnit\Framework\TestCase;

class CalculateStudentTest extends TestCase
{
    /**
     * @param Student $customer
     * @param ShowTime $showTime
     * @param int $expected
     * @dataProvider dataProvider_料金計算できること
     */
    public function test_料金計算できること(Student $customer, ShowTime $showTime, int $expected)
    {
        $calculator = new StudentCalculator();
        $actual = $calculator->exec($customer, $showTime);

        $this->assertEquals($expected, $actual->amount());
    }

    public function dataProvider_料金計算できること()
    {
        return [
            '児童・小学生' => [
                new Student(new Age(9)),
                new ShowTime(Carbon::create(2019, 7, 20, 10, 0, 0)),
                1000
            ],
            '中・高校生' => [
                new Student(new Age(15)),
                new ShowTime(Carbon::create(2019, 7, 20, 10, 0, 0)),
                1000
            ],
            '学生（平日）' => [
                new Student(new Age(19)),
                new ShowTime(Carbon::create(2019, 7, 26, 10, 0, 0)),
                1500
            ],
            '学生（平日レイトショー）' => [
                new Student(new Age(19)),
                new ShowTime(Carbon::create(2019, 7, 26, 20, 0, 0)),
                1300
            ],
            '学生（土日祝）' => [
                new Student(new Age(19)),
                new ShowTime(Carbon::create(2019, 7, 20, 10, 0, 0)),
                1500
            ],
            '学生（土日祝レイトショー）' => [
                new Student(new Age(19)),
                new ShowTime(Carbon::create(2019, 7, 20, 20, 0, 0)),
                1300
            ],
            '学生（映画の日）' => [
                new Student(new Age(19)),
                new ShowTime(Carbon::create(2019, 7, 1, 20, 0, 0)),
                1100
            ],
        ];
    }
}
