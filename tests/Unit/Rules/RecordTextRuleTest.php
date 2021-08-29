<?php

namespace Tests\Unit\Rules;

use App\Rules\RecordTextRule;
use PHPUnit\Framework\TestCase;

class RecordTextRuleTest extends TestCase
{
    /** @test */
    public function it_should_return_true_when_text_contains_15_digits()
    {
        // arrange
        $expected = '場所代碼：111111111111111\n本簡訊是簡訊實聯制發送，限防疫目的使用';

        // act
        $actual = (new RecordTextRule)->passes('text', $expected);

        // assert
        $this->assertTrue($actual);
    }
    /** @test */
    public function it_should_return_false_when_text_does_not_contain_15_digits()
    {
        // arrange
        $expected = '場所代碼：111111\n本簡訊是簡訊實聯制發送，限防疫目的使用';

        // act
        $actual = (new RecordTextRule)->passes('text', $expected);

        // assert
        $this->assertFalse($actual);
    }
}
