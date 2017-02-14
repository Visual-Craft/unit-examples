<?php

namespace Tests\Vadim\UnitExamples;

use PHPUnit_Framework_TestCase;
use Vadim\UnitExamples\AdditionOperator;
use Vadim\UnitExamples\Calculator;
use VladaHejda\AssertException;

class CalculatorTest extends PHPUnit_Framework_TestCase
{
    use AssertException;

    public function testAdd()
    {
        $result = $this->createCalculator()->execute('+', 1, 2);
        $this->assertSame(3, $result);
    }

    /**
     * @test
     * @dataProvider calculatorDataProvider
     *
     * @param int|float $first
     * @param int|float $second
     * @param int|float $expectedResult
     */
    public function addWidthDataProvider($first, $second, $expectedResult)
    {
        $result = $this->createCalculator()->execute('+', $first, $second);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public function calculatorDataProvider()
    {
        return [
            [1, 2, 3],
            [5, 5, 10],
        ];
    }

    /**
     * @dataProvider notValidParametersProvider
     * @expectedException \InvalidArgumentException
     *
     * @param mixed $first
     * @param mixed $second
     */
    public function testExceptionIfParametersIsNotNumeric($first, $second)
    {
        $this->createCalculator()->execute('+', $first, $second);
    }

    /**
     * @return array
     */
    public function notValidParametersProvider()
    {
        return [
            [new \stdClass(), 1],
            [[123], 3],
            [new \DateTime(), 122],
            [1, new \stdClass()],
            [123, [3]],
            [null, 12],
            [12, null],
            ['', 1],
            [1, ''],
        ];
    }

    /**
     * @dataProvider notValidParametersProvider
     *
     * @param mixed $first
     * @param mixed $second
     */
    public function testExceptionIfParametersIsNotNumericWidthAssert($first, $second)
    {
        $calculator = $this->createCalculator();

        $test = function () use ($calculator, $first, $second) {
            $calculator->execute('+', $first, $second);
        };

        $this->assertException($test, \InvalidArgumentException::class);
    }

    private function createCalculator()
    {
        $calculator = new Calculator();
        $calculator
            ->addOperator(new AdditionOperator())
        ;

        return $calculator;
    }
}
