<?php

namespace Tests\VisualCraft\UnitExamples\Fixtures;

use VisualCraft\UnitExamples\OperatorInterface;

class ManualOperatorStub implements OperatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return '/';
    }

    /**
     * {@inheritdoc}
     */
    public function execute(array $args)
    {
        return 2;
    }

    /**
     * {@inheritdoc}
     */
    public function arity()
    {
        return 2;
    }
}
