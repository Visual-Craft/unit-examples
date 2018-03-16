<?php

require_once __DIR__ . '/vendor/autoload.php';

$simpleCalculator = new \VisualCraft\UnitExamples\SimpleCalculator();
echo $simpleCalculator->add(1, 2);
