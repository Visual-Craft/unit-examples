<?php

use VisualCraft\UnitExamples\SimpleCalculator;

describe(SimpleCalculator::class, function () {
    beforeEach(function () {
        $this->calculator = new SimpleCalculator();
    });

    describe('->add()', function () {
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

        foreach ($nonNumericArgs as $index => $item) {
            $should = sprintf(
                'should throw exception when arguments are not numeric #%d (%s, %s)',
                $index + 1,
                gettype($item[0]),
                gettype($item[1])
            );
            it($should, function () use ($item) {
                expect(function () use ($item) {
                    $this->calculator->add($item[0], $item[1]);
                })->toThrow(new \InvalidArgumentException('Arguments is invalid.'));
            });
        }

        $correctArgs = [
            [1, 2, 3],
            [5, 5, 10],
        ];

        foreach ($correctArgs as $item) {
            it(sprintf('should return %d for [%d, %d]', $item[2], $item[0], $item[1]), function () use ($item) {
                expect($this->calculator->add($item[0], $item[1]))->toBe($item[2]);
            });
        }
    });
});
