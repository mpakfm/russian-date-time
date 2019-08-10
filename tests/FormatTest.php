<?php

class FormatTest extends PHPUnit\Framework\TestCase {
    
    public function testFormatD() {
        $dt = date_create_from_format('d.m.Y H:i:s', '05.08.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('D', $dt);
        $this->assertEquals('Пн', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '06.08.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('D', $dt);
        $this->assertEquals('Вт', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '07.08.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('D', $dt);
        $this->assertEquals('Ср', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '08.08.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('D', $dt);
        $this->assertEquals('Чт', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '09.08.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('D', $dt);
        $this->assertEquals('Пт', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '10.08.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('D', $dt);
        $this->assertEquals('Сб', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '11.08.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('D', $dt);
        $this->assertEquals('Вс', $response);
        
        $response = Mpakfm\RussianDateTime::format('D d.m.Y', $dt);
        $this->assertEquals('Вс 11.08.2019', $response);
        
        $response = Mpakfm\RussianDateTime::format('d.m D Yг.', $dt);
        $this->assertEquals('11.08 Вс 2019г.', $response);
    }
    
    public function testFormatl() {
        $dt = date_create_from_format('d.m.Y H:i:s', '05.08.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('l', $dt);
        $this->assertEquals('Понедельник', $response);
        $response = Mpakfm\RussianDateTime::format('l', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('Понедельника', $response);
        $response = Mpakfm\RussianDateTime::format('l', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('Понедельник', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '06.08.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('l', $dt);
        $this->assertEquals('Вторник', $response);
        $response = Mpakfm\RussianDateTime::format('l', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('Вторника', $response);
        $response = Mpakfm\RussianDateTime::format('l', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('Вторник', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '07.08.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('l', $dt);
        $this->assertEquals('Среда', $response);
        $response = Mpakfm\RussianDateTime::format('l', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('Среды', $response);
        $response = Mpakfm\RussianDateTime::format('l', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('Среду', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '08.08.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('l', $dt);
        $this->assertEquals('Четверг', $response);
        $response = Mpakfm\RussianDateTime::format('l', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('Четверга', $response);
        $response = Mpakfm\RussianDateTime::format('l', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('Четверг', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '09.08.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('l', $dt);
        $this->assertEquals('Пятница', $response);
        $response = Mpakfm\RussianDateTime::format('l', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('Пятницы', $response);
        $response = Mpakfm\RussianDateTime::format('l', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('Пятницу', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '10.08.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('l', $dt);
        $this->assertEquals('Суббота', $response);
        $response = Mpakfm\RussianDateTime::format('l', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('Субботы', $response);
        $response = Mpakfm\RussianDateTime::format('l', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('Субботу', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '11.08.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('l', $dt);
        $this->assertEquals('Воскресение', $response);
        $response = Mpakfm\RussianDateTime::format('l', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('Воскресения', $response);
        $response = Mpakfm\RussianDateTime::format('l', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('Воскресение', $response);
        
        $response = Mpakfm\RussianDateTime::format('l d.m.Y', $dt);
        $this->assertEquals('Воскресение 11.08.2019', $response);
        
        $response = Mpakfm\RussianDateTime::format('d.m l Yг.', $dt);
        $this->assertEquals('11.08 Воскресение 2019г.', $response);
    }
    
    public function testFormatf() {
        $dt = date_create_from_format('d.m.Y H:i:s', '05.01.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('f', $dt);
        $this->assertEquals('январь', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('января', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('январе', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.02.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('f', $dt);
        $this->assertEquals('февраль', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('февраля', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('феврале', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.03.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('f', $dt);
        $this->assertEquals('март', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('марта', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('марте', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.04.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('f', $dt);
        $this->assertEquals('апрель', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('апреля', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('апреле', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.05.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('f', $dt);
        $this->assertEquals('май', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('мая', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('мае', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.06.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('f', $dt);
        $this->assertEquals('июнь', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('июня', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('июне', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.07.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('f', $dt);
        $this->assertEquals('июль', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('июля', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('июле', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.08.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('f', $dt);
        $this->assertEquals('август', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('августа', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('августе', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.09.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('f', $dt);
        $this->assertEquals('сентябрь', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('сентября', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('сентябре', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.10.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('f', $dt);
        $this->assertEquals('октябрь', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('октября', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('октябре', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.11.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('f', $dt);
        $this->assertEquals('ноябрь', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('ноября', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('ноябре', $response);
        
        $dt = date_create_from_format('d.m.Y H:i:s', '05.12.2019 12:00:00');
        $response = Mpakfm\RussianDateTime::format('f', $dt);
        $this->assertEquals('декабрь', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('декабря', $response);
        $response = Mpakfm\RussianDateTime::format('f', $dt, Mpakfm\RussianDateTime::FORMAT_INTO);
        $this->assertEquals('декабре', $response);
        
        $response = Mpakfm\RussianDateTime::format('j f Y', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('5 декабря 2019', $response);
        
        $response = Mpakfm\RussianDateTime::format('d l, f Yг.', $dt);
        $this->assertEquals('05 Четверг, декабрь 2019г.', $response);
        
        $response = Mpakfm\RussianDateTime::format('l, ', $dt) . Mpakfm\RussianDateTime::format('j f Yг.', $dt, Mpakfm\RussianDateTime::FORMAT_BY);
        $this->assertEquals('Четверг, 5 декабря 2019г.', $response);
    }
}
