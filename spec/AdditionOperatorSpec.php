<?php

use VisualCraft\UnitExamples\AdditionOperator;

describe(AdditionOperator::class, function () {
    beforeEach(function () {
        $this->operator = new AdditionOperator();
    });

    describe('->execute()', function () {
        $data = [
            [2, 1, 3],
            [-1, 1, 0],
            [-2, -1, -3],
            [0.5, 1, 1.5],
        ];

        foreach ($data as $item) {
            it(sprintf('should return %d for argument [%d, %d]', $item[2], $item[0], $item[1]), function () use ($item) {
                expect($this->operator->execute([$item[0], $item[1]]))->toBe($item[2]);
            });
        }
    });

    describe('->arity()', function () {
        it('should return 2', function () {
            expect($this->operator->arity())->toBe(2);
        });
    });

    describe('->__toString()', function () {
        it("should return '+'", function () {
            expect((string) $this->operator)->toBe('+');
        });
    });
});
