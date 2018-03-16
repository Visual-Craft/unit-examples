<?php

use Kahlan\Plugin\Double;
use Kahlan\Plugin\Stub;
use VisualCraft\UnitExamples\Calculator;
use VisualCraft\UnitExamples\OperatorInterface;

describe(Calculator::class, function () {
    beforeEach(function () {
        $this->operatorStub = Double::instance([
            'implements' => [OperatorInterface::class],
        ]);
        Stub::on($this->operatorStub)->method('arity', function () {
            return 2;
        });
        Stub::on($this->operatorStub)->method('__toString', function () {
            return '/';
        });
        Stub::on($this->operatorStub)->method('execute', function () {
            return 2;
        });
        $this->calculator = new Calculator();
        $this->calculator->addOperator($this->operatorStub);
    });

    describe('->execute()', function () {
        it('should throw exception when operator is missing', function () {
            expect(function () {
                $this->calculator->execute('+', 1, 2);
            })->toThrow(new \RuntimeException("Operator '+' is not supported."));
        });

        it('should throw exception when arguments do not match operator arity', function () {
            expect(function () {
                $this->calculator->execute('/', 1);
            })->toThrow(new \InvalidArgumentException("Operator '/' expects exactly 2 arguments, but 1 provided."));
        });

        it('should throw exception when arguments are not numeric', function () {
            $nonNumericArgs = [
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

            foreach ($nonNumericArgs as $item) {
                expect(function () use ($item) {
                    $this->calculator->execute('/', $item[0], $item[1]);
                })->toThrow(new \InvalidArgumentException('Arguments is invalid.'));
            }
        });

        it("should call operator's 'execute' method once and return correct value", function () {
            expect($this->operatorStub)->toReceive('execute')->with([1, 2])->once();
            expect($this->calculator->execute('/', 1, 2))->toBe(2);
        });
    });
});
