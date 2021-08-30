<?php

namespace Tests\Unit\Services;

use App\Services\RedisService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class RedisServiceTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_should_add_coordinate_to_redis()
    {
        // arrange
        $expected = [
            'id' => 123,
            'lat' => 5.16119795728538833,
            'lng' => 147.11970895528793335,
        ];

        // act
        $actual = app(RedisService::class)->addMerchant($expected['id'], $expected['lat'], $expected['lng']);
        $result = Redis::command('geopos', [RedisService::MERCHANTS_KEY, $expected['id']]);

        // assert
        $this->assertTrue($actual);
        $this->assertEquals($expected['lat'], $result[0][1]);
        $this->assertEquals($expected['lng'], $result[0][0]);
    }

    /** @test */
    public function it_should_return_coordinate_of_id()
    {
        // arrange
        $data = [
            'id' => 123,
            'lat' => 5.16119795728538833,
            'lng' => 147.11970895528793335,
        ];
        Redis::command('geoadd', [RedisService::MERCHANTS_KEY, $data['lng'], $data['lat'], $data['id']]);
        $expected = Redis::command('geopos', [RedisService::MERCHANTS_KEY, $data['id']]);

        // act
        $actual = app(RedisService::class)->getMerchantPos($data['id']);

        // assert
        $this->assertEquals($expected[0][0], $actual['lng']);
        $this->assertEquals($expected[0][1], $actual['lat']);
    }

    /** @test */
    public function it_should_add_uuid_to_sorted_set()
    {
        // arrange
        $expected = [
            'merchant_id' => 1,
            'from' => $this->faker->uuid,
            'time' => now()->timestamp,
        ];

        // act
        app(RedisService::class)->addRecordToMerchant($expected['merchant_id'], $expected['from'], $expected['time']);
        $actual = Redis::command('zscore', [sprintf(RedisService::MERCHANTS_KEY . ':%s', $expected['merchant_id']), $expected['from']]);

        // assert
        $this->assertEquals($expected['time'], $actual);
    }
}
