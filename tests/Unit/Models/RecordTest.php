<?php

namespace Tests\Unit\Models;

use App\Models\Record;
use App\Services\RedisService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class RecordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_add_record_to_redis_when_created()
    {
        // arrange
        $expected = Record::factory()->create();
        $key = sprintf(RedisService::MERCHANTS_KEY . ':%s', $expected->merchant_id);
        $member = "$expected->from:$expected->uuid";

        // act
        $actual = Redis::command('zscore', [$key, $member]);

        // assert
        $this->assertEquals($expected->time->timestamp, $actual);
    }
}
