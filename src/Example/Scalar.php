<?php

namespace Al\Polymorphism\Example;

use Al\Polymorphism\Polymorphism;

class Scalar
{
    use Polymorphism;

    /** @var int */
    private $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function fromInt(int $value)
    {
        return new self($value);
    }

    public static function fromString(string $value)
    {
        return new self((int) $value);
    }

    public function value()
    {
        return $this->value;
    }
}
