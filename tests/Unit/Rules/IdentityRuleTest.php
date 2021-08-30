<?php

namespace Tests\Unit\Rules;

use App\Rules\IdentityRule;
use PHPUnit\Framework\TestCase;

class IdentityRuleTest extends TestCase
{
    /** @test */
    public function it_should_pass_when_identity_is_a_valid_male_id()
    {
        // arrange
        $expected = 'A123456789';

        // act
        $actual = (new IdentityRule)->passes('identity', $expected);

        // assert
        $this->assertTrue($actual);
    }

    /** @test */
    public function it_should_pass_when_identity_is_a_valid_female_id()
    {
        // arrange
        $expected = 'A294796249';

        // act
        $actual = (new IdentityRule)->passes('identity', $expected);

        // assert
        $this->assertTrue($actual);
    }

    /** @test */
    public function it_should_pass_when_identity_is_a_valid_foreigner_male_id()
    {
        // arrange
        $expected = 'AC28781565';

        // act
        $actual = (new IdentityRule)->passes('identity', $expected);

        // assert
        $this->assertTrue($actual);
    }

    /** @test */
    public function it_should_pass_when_identity_is_a_valid_foreigner_female_id()
    {
        // arrange
        $expected = 'AD66311541';

        // act
        $actual = (new IdentityRule)->passes('identity', $expected);

        // assert
        $this->assertTrue($actual);
    }

    /** @test */
    public function it_should_fail_when_identity_is_not_a_valid_id()
    {
        // arrange
        $expected = '1111111222';

        // act
        $actual = (new IdentityRule)->passes('identity', $expected);

        // assert
        $this->assertFalse($actual);
    }
}
