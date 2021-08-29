<?php

namespace Tests\Unit\Rules;

use App\Models\Merchant;
use App\Rules\RecordMerchantNumberRule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecordMerchantNumberRuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_pass_when_merchant_id_is_exist()
    {
        // arrange
        Merchant::factory()->create();
        $expected = '場所代碼：000000000000001\n本簡訊是簡訊實聯制發送，限防疫目的使用';

        // act
        $actual = (new RecordMerchantNumberRule)->passes('text', $expected);

        // assert
        $this->assertTrue($actual);
    }

    /** @test */
    public function it_should_not_pass_when_merchant_id_is_not_exist()
    {
        // arrange
        $expected = '場所代碼：000000000000010\n本簡訊是簡訊實聯制發送，限防疫目的使用';

        // act
        $actual = (new RecordMerchantNumberRule)->passes('text', $expected);

        // assert
        $this->assertFalse($actual);
    }
}
