<?php

use Mpakfm\RussianDateTime;
use PHPUnit\Framework\TestCase;

class FormatTest extends TestCase {
    
    public function testFormatD() {
        $dt = date_create_from_format('d.m.Y H:i:s', '05.08.2019 12:00:00');
        $response = RussianDateTime::format('D', $dt);
        $this->assertEquals('Пн', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '06.08.2019 12:00:00');
        $response = RussianDateTime::format('D', $dt);
        $this->assertEquals('Вт', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '07.08.2019 12:00:00');
        $response = RussianDateTime::format('D', $dt);
        $this->assertEquals('Ср', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '08.08.2019 12:00:00');
        $response = RussianDateTime::format('D', $dt);
        $this->assertEquals('Чт', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '09.08.2019 12:00:00');
        $response = RussianDateTime::format('D', $dt);
        $this->assertEquals('Пт', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '10.08.2019 12:00:00');
        $response = RussianDateTime::format('D', $dt);
        $this->assertEquals('Сб', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '11.08.2019 12:00:00');
        $response = RussianDateTime::format('D', $dt);
        $this->assertEquals('Вс', $response);
        
        $response = RussianDateTime::format('D d.m.Y', $dt);
        $this->assertEquals('Вс 11.08.2019', $response);
        
        $response = RussianDateTime::format('d.m D Yг.', $dt);
        $this->assertEquals('11.08 Вс 2019г.', $response);
    }
    
    public function testFormatl() {
        $dt = date_create_from_format('d.m.Y H:i:s', '05.08.2019 12:00:00');
        $response = RussianDateTime::format('l', $dt);
        $this->assertEquals('Понедельник', $response);
        $response = RussianDateTime::format('l', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('Понедельника', $response);
        $response = RussianDateTime::format('l', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('Понедельник', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '06.08.2019 12:00:00');
        $response = RussianDateTime::format('l', $dt);
        $this->assertEquals('Вторник', $response);
        $response = RussianDateTime::format('l', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('Вторника', $response);
        $response = RussianDateTime::format('l', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('Вторник', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '07.08.2019 12:00:00');
        $response = RussianDateTime::format('l', $dt);
        $this->assertEquals('Среда', $response);
        $response = RussianDateTime::format('l', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('Среды', $response);
        $response = RussianDateTime::format('l', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('Среду', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '08.08.2019 12:00:00');
        $response = RussianDateTime::format('l', $dt);
        $this->assertEquals('Четверг', $response);
        $response = RussianDateTime::format('l', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('Четверга', $response);
        $response = RussianDateTime::format('l', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('Четверг', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '09.08.2019 12:00:00');
        $response = RussianDateTime::format('l', $dt);
        $this->assertEquals('Пятница', $response);
        $response = RussianDateTime::format('l', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('Пятницы', $response);
        $response = RussianDateTime::format('l', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('Пятницу', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '10.08.2019 12:00:00');
        $response = RussianDateTime::format('l', $dt);
        $this->assertEquals('Суббота', $response);
        $response = RussianDateTime::format('l', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('Субботы', $response);
        $response = RussianDateTime::format('l', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('Субботу', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '11.08.2019 12:00:00');
        $response = RussianDateTime::format('l', $dt);
        $this->assertEquals('Воскресение', $response);
        $response = RussianDateTime::format('l', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('Воскресения', $response);
        $response = RussianDateTime::format('l', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('Воскресение', $response);
        
        $response = RussianDateTime::format('l d.m.Y', $dt);
        $this->assertEquals('Воскресение 11.08.2019', $response);
        
        $response = RussianDateTime::format('d.m l Yг.', $dt);
        $this->assertEquals('11.08 Воскресение 2019г.', $response);
    }
    
    public function testFormatf() {
        $dt = date_create_from_format('d.m.Y H:i:s', '05.01.2019 12:00:00');
        $response = RussianDateTime::format('f', $dt);
        $this->assertEquals('январь', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('января', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('январе', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.02.2019 12:00:00');
        $response = RussianDateTime::format('f', $dt);
        $this->assertEquals('февраль', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('февраля', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('феврале', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.03.2019 12:00:00');
        $response = RussianDateTime::format('f', $dt);
        $this->assertEquals('март', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('марта', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('марте', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.04.2019 12:00:00');
        $response = RussianDateTime::format('f', $dt);
        $this->assertEquals('апрель', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('апреля', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('апреле', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.05.2019 12:00:00');
        $response = RussianDateTime::format('f', $dt);
        $this->assertEquals('май', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('мая', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('мае', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.06.2019 12:00:00');
        $response = RussianDateTime::format('f', $dt);
        $this->assertEquals('июнь', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('июня', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('июне', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.07.2019 12:00:00');
        $response = RussianDateTime::format('f', $dt);
        $this->assertEquals('июль', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('июля', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('июле', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.08.2019 12:00:00');
        $response = RussianDateTime::format('f', $dt);
        $this->assertEquals('август', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('августа', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('августе', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.09.2019 12:00:00');
        $response = RussianDateTime::format('f', $dt);
        $this->assertEquals('сентябрь', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('сентября', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('сентябре', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.10.2019 12:00:00');
        $response = RussianDateTime::format('f', $dt);
        $this->assertEquals('октябрь', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('октября', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('октябре', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.11.2019 12:00:00');
        $response = RussianDateTime::format('f', $dt);
        $this->assertEquals('ноябрь', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('ноября', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('ноябре', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.12.2019 12:00:00');
        $response = RussianDateTime::format('f', $dt);
        $this->assertEquals('декабрь', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('декабря', $response);
        $response = RussianDateTime::format('f', $dt, RussianDateTime::FORMAT_INTO);
        $this->assertEquals('декабре', $response);
        
        $response = RussianDateTime::format('j f Y', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('5 декабря 2019', $response);
        
        $response = RussianDateTime::format('d l, f Yг.', $dt);
        $this->assertEquals('05 Четверг, декабрь 2019г.', $response);
        
        $response = RussianDateTime::format('l, ', $dt) . RussianDateTime::format('j f Yг.', $dt, RussianDateTime::FORMAT_BY);
        $this->assertEquals('Четверг, 5 декабря 2019г.', $response);
    }
}
