<?php

namespace spec\Al\Polymorphism\Test;

use Al\Polymorphism\Example\Scalar;
use PhpSpec\ObjectBehavior;

class ScalarSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Scalar::class);
    }
    
    function it_is_constructed_from_int()
    {
        $this->beConstructedThrough('fromInt', [10]);
        $this->value()->shouldReturn(10);
    }
    
    function it_is_constructed_from_string()
    {
        $this->beConstructedThrough('fromString', ['10']);
        $this->value()->shouldReturn(10);
    }

    function it_uses_from_int_constructor()
    {
        $this->beConstructedThrough('from', [10]);
        $this->value()->shouldReturn(10);
    }

    function it_uses_from_string_constructor()
    {
        $this->beConstructedThrough('from', ['10']);
        $this->value()->shouldReturn(10);
    }

    function it_has_a_value()
    {
        $this->beConstructedThrough('fromInt', [10]);
        $this->value()->shouldReturn(10);
    }
}
