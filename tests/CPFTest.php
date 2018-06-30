<?php

use BrUtils\CPF;
use PHPUnit\Framework\TestCase;

class CPFTest extends TestCase
{

    public function testMustBeinvalidWhenCPFIsEmpty()
    {
        $this->assertFalse(CPF::validate(""));
    }

    public function testCPFClear()
    {
        $this->assertEquals('35666895052', CPF::clear('356.668.950-52'));
    }

    public function testInvalidWhenAllNumbersAreEqual()
    {
        $this->assertFalse(CPF::validate('111.111.111-11'));
        $this->assertFalse(CPF::validate('555.555.555-55'));
    }

    /**
     * @dataProvider CPFProvider
     */
    public function testCPFValidation($cpfNumber, $expected)
    {

        $this->assertEquals($expected, CPF::validate($cpfNumber));
    }

    public function testFormatValidCPF()
    {
        $expected = '356.668.950-52';

        $this->assertEquals($expected, CPF::format('35666895052'));
    }


    public function CPFProvider()
    {
        return [
            ['459.959.840-20', true],
            ['175.250-65', false],
            ['245.718.980-29', true],
            ['510.xdf.540-06', false],
            ['024.404.130-03', true],
            ['044.871.090-37', false],
            ['297.480.830-12', true],
            ['937.232.380-25', true],
            ['68252200109', false],
            ['937.806.930-46', true],
            ['063.172.200-01', false],
        ];
    }
}
