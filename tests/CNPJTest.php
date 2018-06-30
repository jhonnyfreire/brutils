<?php

use BrUtils\CNPJ;
use PHPUnit\Framework\TestCase;

class CNPJTest extends TestCase
{

    /**
     * @dataProvider CNPJProvider
     */
    public function testCNPJValidation($cnpjNumber, $expected)
    {

        $this->assertEquals($expected, CNPJ::validate($cnpjNumber));
    }

    public function testFormatValidCNPJ()
    {
        $expected = '33.438.416/0001-45';
        $this->assertEquals($expected, CNPJ::format('33438416000145'));
    }

    public function CNPJProvider()
    {

        return [
            ['45.472.199/0001-99', true],
            ['02.873.832', false],
            ['02.873.832/0001-48', true],
            ['33.438.416/0001-xc', false],
            ['33.438.416/0001-45', true],
            ['00.352.121/0001-03', false],
            ['72.352.121/0001-03', true],
            ['38.217.815/0001-08', true],
            ['68252200109', false],
            ['67331716000142', true],
            ['673317160142', false],
        ];

    }

}
