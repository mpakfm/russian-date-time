# russian-date-time
Русский вывод строковых значений format character (D, l, F, f, M)
>Параметр f не используется в php DateTime

##format

Форматирование даты с русскими строками в названиях дней недели и месяцев. 
* D и l	Текстовое представление дня месяца, например Пн либо Среда      От Пн до Вс либо от Понедельник до Воскресение
* F и M	Текстовое представление месяца, например Января или Сен         С Января по Декабря либо с Янв по Дек
* f	Текстовое представление месяца, например января	                С января по декабря

##listFormat

Вывод каждой даты интервала по дням с использование метода format в виде {formatted_day}, {formatted_day}, {formatted_day} {formatted month}

* Строковое представление периода из дней через разделитель
* Важно учитывать что период задается от и до поэтому время считается и выводится по времени установленному в объекте DateTime $begin
*  Падеж по умолчанию: Понедельник, но Января
*      "j f", $d1, $d2           => 2, 3, 4 мая
*      "l d F", $d1, $d2         => Понедельник 09, Вторник 10, Среда 11 Ноября
*      "j F Yг. H:i", $d1, $d2   => 30, 31 Дек 2019г., 1 Янв 2020г 20:00.
*  Падежы передаются в параметрах:
*      "в l j f H:i", $d1, $d2, RussianDateTime::FORMAT_INTO                                      => в среду 9, четверг 10 февраля 12:00
*      "l d H:i F Yг.", $d1, $d2, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME, ';' => 30 Чт; 31 Пт Февраль 20:00; 01 Сб Март 20:00 2019г.
*      "F j H:i Yг.", $d1, $d2, RussianDateTime::FORMAT_NAME, RussianDateTime::FORMAT_NAME, ';'   => Февраль 30; 31 20:00; Март 1 20:00 2019г.