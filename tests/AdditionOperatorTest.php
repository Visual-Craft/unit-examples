<?php

namespace Tests\VisualCraft\UnitExamples;

use PHPUnit_Framework_TestCase;
use VisualCraft\UnitExamples\AdditionOperator;

class AdditionOperatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider operatorDataProvider
     *
     * @param float|int $first
     * @param float|int $second
     * @param float|int $expectedResult
     */
    public function testExecute($first, $second, $expectedResult)
    {
        $operator = new AdditionOperator();

        $result = $operator->execute([$first, $second]);

        $this->assertSame($expectedResult, $result);
    }

    public function testArity()
    {
        $operator = new AdditionOperator();

        $result = $operator->arity();

        $this->assertSame(2, $result);
    }

    public function test__toString()
    {
        $operator = new AdditionOperator();

        $result = (string) $operator;

        $this->assertSame('+', $result);
    }

    /**
     * @return array
     */
    public function operatorDataProvider()
    {
        return [
            [2, 1, 3],
            [-1, 1, 0],
            [-2, -1, -3],
            [0.5, 1, 1.5],
        ];
    }
}
