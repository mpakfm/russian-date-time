<?php
/**
 * RussianDateTime
 * 
 * @author mpakfm <mpakfm@google.com>
 * @package \Mpakfm\RussianDateTime
 * @version 1.0.0
 */

namespace Mpakfm;

class RussianDateTime {

    const FORMAT_TYPE_LC_DEFAULT = 0; // пятница 3 февраля
    const FORMAT_TYPE_UC_FIRST   = 1; // Пятница 3 Февраля
    const FORMAT_TYPE_UC_WORDS   = 2; // Пятница 3 февраля
    const FORMAT_TYPE_UC_ALL     = 3; // ПЯТНИЦА 3 ФЕВРАЛЯ
    
    const FORMAT_NAME = 0;
    const FORMAT_BY   = 1;
    const FORMAT_INTO = 2;
    
    private static $caseVariant = [
        self::FORMAT_NAME, self::FORMAT_BY, self::FORMAT_INTO
    ];

        private static $dayName = [
        1 => 'понедельник',
        2 => 'вторник',
        3 => 'среда',
        4 => 'четверг',
        5 => 'пятница',
        6 => 'суббота',
        7 => 'воскресение',
    ];

    private static $dayBy = [
        1 => 'понедельника',
        2 => 'вторника',
        3 => 'среды',
        4 => 'четверга',
        5 => 'пятницы',
        6 => 'субботы',
        7 => 'воскресения',
    ];

    private static $dayInto = [
        1 => 'понедельник',
        2 => 'вторник',
        3 => 'среду',
        4 => 'четверг',
        5 => 'пятницу',
        6 => 'субботу',
        7 => 'воскресение',
    ];

    private static $monthName = [
        1  => 'январь',
        2  => 'февраль',
        3  => 'март',
        4  => 'апрель',
        5  => 'май',
        6  => 'июнь',
        7  => 'июль',
        8  => 'август',
        9  => 'сентябрь',
        10 => 'октябрь',
        11 => 'ноябрь',
        12 => 'декабрь',
    ];

    private static $monthBy = [
        1  => 'января',
        2  => 'февраля',
        3  => 'марта',
        4  => 'апреля',
        5  => 'мая',
        6  => 'июня',
        7  => 'июля',
        8  => 'августа',
        9  => 'сентября',
        10 => 'октября',
        11 => 'ноября',
        12 => 'декабря',
    ];

    private static $monthInto = [
        1  => 'январе',
        2  => 'феврале',
        3  => 'марте',
        4  => 'апреле',
        5  => 'мае',
        6  => 'июне',
        7  => 'июле',
        8  => 'августе',
        9  => 'сентябре',
        10 => 'октябре',
        11 => 'ноябре',
        12 => 'декабре',
    ];
    
    public static $case = 0;

    /**
     * D и l	Текстовое представление дня месяца, например Пн либо Среда      От Пн до Вс либо от Понедельник до Воскресение
     * F и M	Текстовое представление месяца, например Января или Сен         С Января по Декабря либо с Янв по Дек
     * f	Текстовое представление месяца, например января	                С января по декабря
     */
    public static function format(string $format, \DateTime $dateTime, int $case = 0) {
        if (in_array($case, static::$caseVariant)) {
            static::$case = $case;
        }
        if (strpos($format, 'D') !== false) {
            $str = self::makeShortDay($dateTime->format('w'), static::FORMAT_TYPE_UC_WORDS);
            $format = str_replace('D', $str, $format);
        }
        if (strpos($format, 'l') !== false) {
            $str = self::makeLongDay($dateTime->format('w'), static::FORMAT_TYPE_UC_WORDS);
            $format = str_replace('l', $str, $format);
        }
        if (strpos($format, 'F') !== false) {
            $str = self::makeLongMonth($dateTime->format('n'), static::FORMAT_TYPE_UC_WORDS);
            $format = str_replace('F', $str, $format);
        }
        if (strpos($format, 'f') !== false) {
            $str = self::makeLongMonth($dateTime->format('n'));
            $format = str_replace('f', $str, $format);
        }
        if (strpos($format, 'M') !== false) {
            $str = self::makeShortMonth($dateTime->format('n'), static::FORMAT_TYPE_UC_WORDS);
            $format = str_replace('M', $str, $format);
        }
        return $dateTime->format($format);
    }

    public static function listFormat(string $format, \DateTime $begin, \DateTime $end) {
        $interval  = new \DateInterval('P1D');
        $dateRange = new \DatePeriod($begin, $interval ,$end);
        $monthList = [];
        foreach($dateRange as $date){
            $month               = $date->format('n');
            $monthList[$month][] = $date;
        }

        $month = $dateRange->current->format('n');
        $monthList[$month][] = $dateRange->current;

        // If string month in format
        if (strpos($format, 'F') !== false || strpos($format, 'f') !== false || strpos($format, 'M') !== false) {
            if (strpos($format, 'F') !== false) {
                $monthFormat = 'F';
            }
            if (strpos($format, 'f') !== false) {
                $monthFormat = 'f';
            }
            if (strpos($format, 'M') !== false) {
                $monthFormat = 'M';
            }
            $nonMonthFormat = trim(str_replace($monthFormat, '', $format));
            $items          = [];
            foreach ($monthList as $month => $dates) {
                foreach ($dates as $date) {
                    $items[] = self::format($nonMonthFormat, $date);
                }
                $lastItem  = array_pop($items);
                $items[]   = $lastItem . ' ' . self::format($monthFormat, $date);
            }
            $str = implode(', ', $items);
        // Without month
        } else {
            $dates = [];
            foreach ($monthList as $month) {
                foreach ($month as $date) {
                    $dates[] = self::format($format, $date);
                }
            }
            $str = implode(', ', $dates);
        }
        return $str;
    }

    public static function makeLongDay(int $day, int $type = 0): string {
        if ($day == 0) {
            $day = 7;
        }
        if (static::$case == static::FORMAT_NAME) {
            $dayName = static::$dayName;
        } elseif (static::$case == static::FORMAT_BY) {
             $dayName = static::$dayBy;
        } elseif (static::$case == static::FORMAT_INTO) {
             $dayName = static::$dayInto;
        }
        if ($type == static::FORMAT_TYPE_LC_DEFAULT || $type == static::FORMAT_TYPE_UC_FIRST) {
            return $dayName[$day];
        }
        if ($type == static::FORMAT_TYPE_UC_WORDS) {
            return mb_convert_case($dayName[$day], MB_CASE_TITLE, "UTF-8");
        }
        if ($type == static::FORMAT_TYPE_UC_ALL) {
            return mb_convert_case($dayName[$day], MB_CASE_UPPER, "UTF-8");
        }
    }

    public static function makeShortDay(int $day, int $type = 0): string {
        if ($day == 0) {
            $day = 7;
        }
        if ($day == 1 || $day == 4 || $day == 5 || $day == 6 || $day == 7) {
            $str = self::makeLongDay($day, $type);
            return (mb_substr($str, 0, 1, "UTF-8") . mb_substr($str, 2, 1, "UTF-8"));
        } else {
            return mb_substr(self::makeLongDay($day, $type), 0, 2, "UTF-8");
        }
    }

    public static function makeLongMonth(int $month, int $type = 0): string {
        if (static::$case == static::FORMAT_NAME) {
            $monthName = static::$monthName;
        } elseif (static::$case == static::FORMAT_BY) {
            $monthName = static::$monthBy;
        } elseif (static::$case == static::FORMAT_INTO) {
            $monthName = static::$monthInto;
        }
        if ($type == static::FORMAT_TYPE_LC_DEFAULT || $type == static::FORMAT_TYPE_UC_FIRST) {
            return $monthName[$month];
        }
        if ($type == static::FORMAT_TYPE_UC_WORDS) {
            return mb_convert_case($monthName[$month], MB_CASE_TITLE, "UTF-8");
        }
        if ($type == static::FORMAT_TYPE_UC_ALL) {
            return mb_convert_case($monthName[$month], MB_CASE_UPPER, "UTF-8");
        }
    }

    public static function makeShortMonth(int $month, int $type = 0): string {
        return mb_substr(self::makeLongMonth($month, $type), 0, 3, "UTF-8");
    }
}
