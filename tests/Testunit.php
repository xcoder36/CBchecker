<?php

require '../Controller.php';

class Testunit extends PHPUnit_Framework_TestCase
{

    public $controller;

    public function setUp(){
        $this->controller = new Controller();
    }

    public function testcharschecknumber(){
        $this->assertEquals("Nombre non valide",$this->controller->checkcb('abcdefmnop', 123,12, 2050,10));
    }

    public function testundernumberchecknumber(){
        $this->assertEquals("Nombre non valide",$this->controller->checkcb('12345', 123,12, 2050,10));
    }

    public function testovernumberchecknumber(){
        $this->assertEquals("Nombre non valide",$this->controller->checkcb('1234567890123456789', 123,12, 2050,10));
    }

    public function testspecialcharschecknumber(){
        $this->assertEquals("Nombre non valide",$this->controller->checkcb('?./§,;:!ù^*µ$£@&', 123,12, 2050,10));
    }

    public function testmixedcharschecknumber(){
        $this->assertEquals("Nombre non valide",$this->controller->checkcb('1234azert!:;,147', 123,12, 2050,10));
    }

    public function testcharscheckcvv(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("CVV non valide",$this->controller->checkcb($nbaleatoirecb, 'abc',12, 2050,10));
    }

    public function testundernumbercheckcvv(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("CVV non valide",$this->controller->checkcb($nbaleatoirecb, '5',12, 2050,10));
    }

    public function testovernumbercheckcvv(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("CVV non valide",$this->controller->checkcb($nbaleatoirecb, '5567',12, 2050,10));
    }

    public function testspecialcharscheckcvv(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("CVV non valide",$this->controller->checkcb($nbaleatoirecb, '1,2',12, 2050,10));
    }

    public function testmixedcharscheckcvv(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("CVV non valide",$this->controller->checkcb($nbaleatoirecb, '1a!',12, 2050,10));
    }

    public function testcharscharscheckmonth(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("erreur date",$this->controller->checkcb($nbaleatoirecb, 123,'ab', 2050,10));
    }

    public function testundernumberscharscheckmonth(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("erreur date",$this->controller->checkcb($nbaleatoirecb, 123,'0', 2050,10));
    }

    public function testovernumberscharscheckmonth(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("erreur date",$this->controller->checkcb($nbaleatoirecb, 123,'1234', 2050,10));
    }

    public function testspecialcharscheckmonth(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("erreur date",$this->controller->checkcb($nbaleatoirecb, 123,'?!', 2050,10));
    }

    public function testmixedcharscheckmonth(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("erreur date",$this->controller->checkcb($nbaleatoirecb, 123,'a0', 2050,10));
    }

    public function testcharscharscheckyear(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("erreur date",$this->controller->checkcb($nbaleatoirecb, 123,12,'abcd',10));
    }

    public function testspecialcharscheckyear(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("erreur date",$this->controller->checkcb($nbaleatoirecb, 123,12, '205!',10));
    }

    public function testmixedcharscheckyear(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("erreur date",$this->controller->checkcb($nbaleatoirecb, 123,12, '2!5n',10));
    }

    public function testanteriorbyyearcharscheckyear(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("erreur date",$this->controller->checkcb($nbaleatoirecb, 123,12, '2014',10));
    }
    public function testanteriorbymonthcharscheckyear(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("erreur date",$this->controller->checkcb($nbaleatoirecb, 123,01,2017,10));
    }

    public function testcharscheckprice(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("Nombre non valide",$this->controller->checkcb($nbaleatoirecb, 123,12, 2050,'ab'));
    }

    public function testspecialcharscheckprice(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("Nombre non valide",$this->controller->checkcb($nbaleatoirecb, 123,12, 2050,'1!'));
    }

    public function testmixedcharscheckprice(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("Nombre non valide",$this->controller->checkcb($nbaleatoirecb, 123,12, 2050,'150'));
    }

    public function testoverpricecheckprice(){
        $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
        $this->assertEquals("Nombre non valide",$this->controller->checkcb($nbaleatoirecb, 123,12, 2050,250));
    }
}
