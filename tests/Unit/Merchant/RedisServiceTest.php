<?php

namespace Tests\Unit\Merchant;

use Domain\Merchant\RedisService;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class RedisServiceTest extends TestCase
{
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
        $actual = app(RedisService::class)->geoAdd($expected['id'], $expected['lat'], $expected['lng']);
        $result = Redis::command('geopos', [RedisService::KEY, $expected['id']]);

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
        Redis::command('geoadd', [RedisService::KEY, $data['lng'], $data['lat'], $data['id']]);
        $expected = Redis::command('geopos', [RedisService::KEY, $data['id']]);

        // act
        $actual = app(RedisService::class)->geoPos($data['id']);

        // assert
        $this->assertEquals($expected[0][0], $actual['lng']);
        $this->assertEquals($expected[0][1], $actual['lat']);
    }
}
