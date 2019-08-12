<?php

use Mpakfm\RussianDateTime;
use PHPUnit\Framework\TestCase;

/**
 * Class FormatTest
 * @covers RussianDateTime::listFormat
 */
class ListFormatTest extends TestCase {

    public function testFormatOneMonthPeriod() {
        $begin = date_create_from_format('d.m.Y H:i:s', '05.08.2019 12:00:00');
        $end   = date_create_from_format('d.m.Y H:i:s', '06.08.2019 12:00:00');
        $response = RussianDateTime::listFormat("в H:i l j Yг.", $begin, $end);
        $this->assertEquals('в 12:00 Понедельник 5, Вторник 6 2019г.', $response);
        $response = RussianDateTime::listFormat("j F", $begin, $end, 0, 1, '; ');
        $this->assertEquals('5; 6 Августа', $response);
        $response = RussianDateTime::listFormat("j f", $begin, $end);
        $this->assertEquals('5, 6 августа', $response);
        $response = RussianDateTime::listFormat("j M", $begin, $end);
        $this->assertEquals('5, 6 Авг', $response);
        $response = RussianDateTime::listFormat("F j", $begin, $end, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME);
        $this->assertEquals('Август 5, 6', $response);
        $response = RussianDateTime::listFormat("F j Yг. в H:i", $begin, $end, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME);
        $this->assertEquals('Август 5, 6 2019г. в 12:00', $response);
        $response = RussianDateTime::listFormat("F j-ого H:i", $begin, $end, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME);
        $this->assertEquals('Август 5-ого, 6-ого 12:00', $response);
        $response = RussianDateTime::listFormat("j F в H:i", $begin, $end);
        $this->assertEquals('5, 6 Августа в 12:00', $response);
        $response = RussianDateTime::listFormat("Y F j", $begin, $end, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME);
        $this->assertEquals('2019 Август 5, 6', $response);
        $response = RussianDateTime::listFormat("H:i Y F j", $begin, $end, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME);
        $this->assertEquals('12:00 2019 Август 5, 6', $response);
        $response = RussianDateTime::listFormat("Y F j H:i", $begin, $end, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME);
        $this->assertEquals('2019 Август 5, 6 12:00', $response);
        $response = RussianDateTime::listFormat("Y F j, W неделя H:i", $begin, $end, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME);
        $this->assertEquals('2019 Август 5, 32 неделя, 6, 32 неделя 12:00', $response);
    }

    public function testFormatTwoMonthPeriod() {
        $begin = date_create_from_format('d.m.Y H:i:s', '30.08.2019 12:00:00');
        $end   = date_create_from_format('d.m.Y H:i:s', '01.09.2019 12:00:00');
        $response = RussianDateTime::listFormat("l j F", $begin, $end);
        $this->assertEquals('Пятница 30, Суббота 31 Августа, Воскресение 1 Сентября', $response);
        $response = RussianDateTime::listFormat("l j", $begin, $end);
        $this->assertEquals('Пятница 30, Суббота 31, Воскресение 1', $response);
        $response = RussianDateTime::listFormat("j F", $begin, $end);
        $this->assertEquals('30, 31 Августа, 1 Сентября', $response);
        $response = RussianDateTime::listFormat("j F Yг. H:i", $begin, $end);
        $this->assertEquals('30, 31 Августа, 1 Сентября 2019г. 12:00', $response);
        $response = RussianDateTime::listFormat("j F H:i", $begin, $end);
        $this->assertEquals('30, 31 Августа, 1 Сентября 12:00', $response);
        $response = RussianDateTime::listFormat("F j H:i", $begin, $end, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME);
        $this->assertEquals('Август 30, 31, Сентябрь 1 12:00', $response);
        $response = RussianDateTime::listFormat("Y F j", $begin, $end, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME);
        $this->assertEquals('2019 Август 30, 31, Сентябрь 1', $response);
        $response = RussianDateTime::listFormat("H:i Y F j", $begin, $end, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME);
        $this->assertEquals('12:00 2019 Август 30, 31, Сентябрь 1', $response);
        $response = RussianDateTime::listFormat("Y F j H:i", $begin, $end, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME);
        $this->assertEquals('2019 Август 30, 31, Сентябрь 1 12:00', $response);
    }

    public function testFormatTwoYearPeriod() {
        $begin = date_create_from_format('d.m.Y H:i:s', '30.12.2019 12:00:00');
        $end   = date_create_from_format('d.m.Y H:i:s', '02.01.2020 12:00:00');
        $response = RussianDateTime::listFormat("j F Yг.", $begin, $end);
        $this->assertEquals('30, 31 Декабря 2019г., 1, 2 Января 2020г.', $response);
        $response = RussianDateTime::listFormat("l j F", $begin, $end);
        $this->assertEquals('Понедельник 30, Вторник 31 Декабря, Среда 1, Четверг 2 Января', $response);
        $response = RussianDateTime::listFormat("l j F Yг. H:i", $begin, $end);
        $this->assertEquals('Понедельник 30, Вторник 31 Декабря 2019г. 12:00, Среда 1, Четверг 2 Января 2020г. 12:00', $response);
        $response = RussianDateTime::listFormat("F j Yг.", $begin, $end, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME);
        $this->assertEquals('Декабрь 30, 31 2019г., Январь 1, 2 2020г.', $response);
        $response = RussianDateTime::listFormat("Y F j", $begin, $end, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME);
        $this->assertEquals('2019 Декабрь 30, 31, 2020 Январь 1, 2', $response);
        $response = RussianDateTime::listFormat("H:i Y F j", $begin, $end, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME);
        $this->assertEquals('12:00 2019 Декабрь 30, 31, 2020 Январь 1, 2', $response);
        $response = RussianDateTime::listFormat("Y F j H:i", $begin, $end, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME);
        $this->assertEquals('2019 Декабрь 30, 31, 2020 Январь 1, 2 12:00', $response);
    }
}
