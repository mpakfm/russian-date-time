<?php
/**
 * RussianDateTime
 * 
 * @author mpakfm <mpakfm@google.com>
 * @package \Mpakfm\RussianDateTime
 * @version 1.0.2
 */

namespace Mpakfm;

class RussianDateTime {

    const FORMAT_TYPE_LC_DEFAULT = 0; // пятница 3 февраля
    const FORMAT_TYPE_UC_FIRST   = 1; // Пятница 3 Февраля
    const FORMAT_TYPE_UC_WORDS   = 2; // Пятница 3 февраля
    const FORMAT_TYPE_UC_ALL     = 3; // ПЯТНИЦА 3 ФЕВРАЛЯ

    const FORMAT_NAME = 0; // пятница февраль
    const FORMAT_BY   = 1; // пятницы февраля
    const FORMAT_INTO = 2; // пятницу феврале

    const DEFAULT_DELIMITER = ', ';

    private static $caseVariant = [
        self::FORMAT_NAME, self::FORMAT_BY, self::FORMAT_INTO
    ];

    private static $phpDaysFormat = [
        'd', 'D', 'j', 'l', 'N', 'S', 'w', 'z', 'W'
    ];

    private static $phpMonthFormat = [
        'F', 'm', 'M', 'n', 't', 'f',
    ];

    private static $phpYearFormat = [
        'L', 'o', 'Y', 'y',
    ];

    private static $phpTimeFormat = [
        'a', 'A', 'B', 'g', 'G', 'h', 'H', 'i', 's', 'u', 'v',
    ];

    private static $phpTimezoneFormat = [
        'e', 'I', 'O', 'P', 'T', 'Z',
    ];

    private static $phpFullDateTimeFormat = [
        'c', 'r', 'U',
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

    public static $listDelimiter = ', ';

    /**
     * D и l	Текстовое представление дня месяца, например Пн либо Среда      От Пн до Вс либо от Понедельник до Воскресение
     * F и M	Текстовое представление месяца, например Января или Сен         С Января по Декабря либо с Янв по Дек
     * f	Текстовое представление месяца, например января	                С января по декабря
     */
    public static function format(string $format, \DateTime $dateTime, int $case = 0): string {
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

    /**
     * Строковое представление периода из дней через запятую
     * Важно учитывать что период задается от и до поэтому время считается и выводится по времени установленному в объекте DateTime $begin
     * @todo продумать вывод времени с ЧЧ:ММ по ЧЧ:ММ где время используется от обоих объектов DateTime: $begin, $end
     *  Падеж по умолчанию: Понедельник, но Января
     *      "j f", $d1, $d2           => 2, 3, 4 мая
     *      "l d F", $d1, $d2         => Понедельник 09, Вторник 10, Среда 11 Ноября
     *      "j F Yг. H:i", $d1, $d2   => 30, 31 Дек 2019г., 1 Янв 2020г 20:00.
     *  Падежы передаются в параметрах:
     *      "в l j f H:i", $d1, $d2, RussianDateTime::FORMAT_INTO                                      => в среду 9, четверг 10 февраля 12:00
     *      "l d H:i F Yг.", $d1, $d2, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME, ';' => 30 Чт; 31 Пт Февраль 20:00; 01 Сб Март 20:00 2019г.
     *      "F j H:i Yг.", $d1, $d2, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME, ';'   => Февраль 30; 31 20:00; Март 1 20:00 2019г.
     *
     */
    public static function listFormat(string $format, \DateTime $begin, \DateTime $end, int $caseDay = 0, int $caseMonth = 1, string $delimiter = null): string {
        if (!in_array($caseDay, static::$caseVariant)) {
            $caseDay = static::FORMAT_NAME;
        }
        if (!in_array($caseMonth, static::$caseVariant)) {
            $caseMonth = static::FORMAT_BY;
        }
        if (!is_null($delimiter)) {
            static::$listDelimiter = $delimiter;
        } else {
            static::$listDelimiter = static::DEFAULT_DELIMITER;
        }

        $onceTimeFormat = array_merge(static::$phpTimeFormat, static::$phpTimezoneFormat);
        $allFormat      = array_merge(static::$phpDaysFormat, static::$phpMonthFormat, static::$phpYearFormat, $onceTimeFormat);

        $onceTimePosition = [];
        $yearPosition     = [];
        $monthPosition    = [];
        $dayPosition      = [];

        $onceTimeFormatString = '';
        $yearFormatString     = '';
        $monthFormatString    = '';
        $dayFormatString      = '';
        $unknownFormatString  = '';
        $typeFormatLetters    = null;

        for ($i = 0; $i < strlen($format); $i++) {
            $letter = $format[$i];
            if (in_array($letter, static::$phpFullDateTimeFormat)) {
                throw new \Exception('Cannot use full format characters for date list: ' . implode(', ', static::$phpFullDateTimeFormat));
            }
            if (in_array($letter, $onceTimeFormat)) {
                $typeFormatLetters    = 'ONCE';
                $onceTimePosition[]   = strpos($format, $letter);
                $onceTimeFormatString .= $letter;
            }
            if (in_array($letter, static::$phpYearFormat)) {
                $typeFormatLetters = 'YEAR';
                $yearPosition[]    = strpos($format, $letter);
                $yearFormatString  .= $letter;
            }
            if (in_array($letter, static::$phpMonthFormat)) {
                $typeFormatLetters = 'MONTH';
                $monthPosition[]   = strpos($format, $letter);
                $monthFormatString .= $letter;
            }
            if (in_array($letter, static::$phpDaysFormat)) {
                $typeFormatLetters = 'DAY';
                $dayPosition[]     = strpos($format, $letter);
                $dayFormatString   .= $letter;
            }
            if (!in_array($letter, $allFormat)) {
                if ($typeFormatLetters == 'ONCE') {
                    $onceTimeFormatString .= $letter;
                } elseif ($typeFormatLetters == 'YEAR') {
                    $yearFormatString .= $letter;
                } elseif ($typeFormatLetters == 'MONTH') {
                    $monthFormatString .= $letter;
                } elseif ($typeFormatLetters == 'DAY') {
                    $dayFormatString .= $letter;
                } else {
                    $unknownFormatString .= $letter;
                }
            }
        }
        if (empty($dayPosition)) {
            throw new \Exception('It makes no sense to use list formatting without specifying the format of the day');
        }

        $minPosition = [];

        if (!empty($onceTimePosition)) {
            $minPosition['ONCE'] = min($onceTimePosition);
        }

        if (!empty($yearPosition)) {
            $minPosition['YEAR'] = min($yearPosition);
        }

        $earlyMonth = null;
        if (!empty($monthPosition)) {
            $minPosition['MONTH'] = min($monthPosition);
        }
        $minPosition['DAY'] = min($dayPosition);
        asort($minPosition);

        $interval  = new \DateInterval('P1D');
        $dateRange = new \DatePeriod($begin, $interval ,$end);
        $yearList  = [];
        foreach($dateRange as $date){
            $month                      = $date->format('n');
            $year                       = $date->format('Y');
            $yearList[$year][$month][]  = $date;
        }
        $month                      = $dateRange->current->format('n');
        $year                       = $dateRange->current->format('Y');
        $yearList[$year][$month][]  = $dateRange->current;

        $listItems = [];

        foreach ($yearList as $year => $monthList) {
            $listItems[$year]['monthListItems'] = [];
            foreach ($monthList as $month => $dayList) {
                $listItems[$year]['month'][$month]['dayListItems'] = [];
                foreach ($dayList as $date) {
                    $listItems[$year]['month'][$month]['dayListItems'][] = trim(self::format($dayFormatString, $date, $caseDay));
                }
                $listItems[$year]['month'][$month]['dayListItemsString'] = implode(static::$listDelimiter, $listItems[$year]['month'][$month]['dayListItems']);
                $listItems[$year]['month'][$month]['monthListItems']     = self::format($monthFormatString, $date, $caseMonth);
            }
            $listItems[$year]['yearItem'] = $date->format($yearFormatString);
        }
        $onceTimeItem = $date->format($onceTimeFormatString);

        $strArray = [];
        if (strlen($unknownFormatString)) {
            $strArray[] = $unknownFormatString;
        }
        foreach ($minPosition as $key => $value) {
            if ($key == 'DAY') {
                $lastMinValue = $value;
                $yearStr      = [];
                foreach ($listItems as $year => $yearEl) {
                    $yearStrArray = [];
                    foreach ($minPosition as $key => $value) {
                        if ($value < $lastMinValue) {
                            continue;
                        }
                        if ($key == 'ONCE') {
                            $yearStrArray[] = $onceTimeItem;
                        } elseif ($key == 'DAY') {
                            $monthStrArray = [];
                            foreach ($yearEl['month'] as $month => $monthEl) {
                                $monthStrArray[] = trim($monthEl['dayListItemsString'] . ' ' . $monthEl['monthListItems']);
                            }
                            $yearStrArray[] = implode(static::$listDelimiter, $monthStrArray) . ' ';
                        } elseif ($key == 'YEAR') {
                            $yearStrArray[] = $yearEl['yearItem'];
                        }
                    }
                    $yearStr[] = trim(implode('', $yearStrArray));
                }
                $strArray[] = implode(static::$listDelimiter, $yearStr);
                break;
            } elseif ($key == 'MONTH') {
                $lastMinValue = $value;
                $yearStr      = [];
                foreach ($listItems as $year => $yearEl) {
                    $yearStrArray = [];
                    foreach ($minPosition as $key => $value) {
                        if ($value <= $lastMinValue) {
                            continue;
                        }
                        if ($key == 'ONCE') {
                            $yearStrArray[] = $onceTimeItem;
                        } elseif ($key == 'DAY') {
                            $monthStrArray = [];
                            foreach ($yearEl['month'] as $month => $monthEl) {
                                $monthStrArray[] = trim($monthEl['monthListItems'] . $monthEl['dayListItemsString']);
                            }
                            $yearStrArray[] = implode(static::$listDelimiter, $monthStrArray) . ' ';
                        } elseif ($key == 'YEAR') {
                            $yearStrArray[] = $yearEl['yearItem'];
                        }
                    }
                    $yearStr[] = trim(implode('', $yearStrArray));
                }
                $strArray[] = implode(static::$listDelimiter, $yearStr);
                break;
            } elseif ($key == 'YEAR') {
                $lastMinValue = $value;
                $yearStr      = [];
                foreach ($listItems as $year => $yearEl) {
                    $yearStrArray   = [];
                    $yearStrArray[] = $yearEl['yearItem'];
                    foreach ($minPosition as $key => $value) {
                        if ($value <= $lastMinValue) {
                            continue;
                        }
                        if ($key == 'DAY') {
                            $monthStrArray = [];
                            foreach ($yearEl['month'] as $month => $monthEl) {
                                $monthStrArray[] = $monthEl['dayListItemsString'] . ' ' . $monthEl['monthListItems'];
                            }
                            $yearStrArray[] = implode(static::$listDelimiter, $monthStrArray);
                            break;
                        } elseif ($key == 'MONTH') {
                            $monthStrArray = [];
                            foreach ($yearEl['month'] as $month => $monthEl) {
                                $monthStrArray[] = $monthEl['monthListItems'] . $monthEl['dayListItemsString'];
                            }
                            $yearStrArray[] = implode(static::$listDelimiter, $monthStrArray);
                            break;
                        }
                    }
                    $yearStr[] = trim(implode('', $yearStrArray));
                }
                $strArray[] = implode(static::$listDelimiter, $yearStr);
                if (isset($minPosition['ONCE']) && $minPosition['ONCE'] > $value) {
                    $strArray[] = ' ' . $onceTimeItem;
                }
                break;
            } elseif ($key == 'ONCE') {
                $strArray[] = $onceTimeItem;
            }
        }
        return trim(implode('', $strArray));
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
