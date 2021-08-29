<?php

namespace Tests\Unit\Rules;

use App\Rules\PhoneRule;
use PHPUnit\Framework\TestCase;

class PhoneRuleTest extends TestCase
{
    /** @test */
    public function it_should_return_true_when_number_is_0912345678()
    {
        // arrange
        $expected = '0912345678';

        // act
        $actual = (new PhoneRule)->passes('from', $expected);

        // assert
        $this->assertTrue($actual);
    }

    /** @test */
    public function it_should_return_true_when_number_is_0912_345_678()
    {
        // arrange
        $expected = '0912-345-678';

        // act
        $actual = (new PhoneRule)->passes('from', $expected);

        // assert
        $this->assertTrue($actual);
    }

    /** @test */
    public function it_should_return_true_when_number_is_886912345678()
    {
        // arrange
        $expected = '(+886)912345678';

        // act
        $actual = (new PhoneRule)->passes('from', $expected);

        // assert
        $this->assertTrue($actual);
    }
}
