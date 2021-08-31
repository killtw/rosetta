<?php

namespace Tests\Unit\Models;

use App\Models\Merchant;
use App\Services\RedisService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MerchantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_add_merchant_to_redis_when_created()
    {
        // arrange
        $expected = Merchant::factory()->create();

        // act
        $actual = app(RedisService::class)->getMerchantPos($expected->id);

        // assert
        $this->assertEquals($expected->location, $actual);
    }
}
