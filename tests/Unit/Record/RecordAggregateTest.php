<?php

namespace Tests\Unit\Record;

use Domain\Record\Events\RecordCreated;
use Domain\Record\RecordAggregate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecordAggregateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_create_record()
    {
        // arrange
        $expected = [
            'merchant_id' => 1,
            'from' => '0912345678',
            'time' => '2021-01-01T00:00:00',
        ];

        // act
        $actual = RecordAggregate::fake()
            ->when(fn (RecordAggregate $aggregate) => $aggregate->create($expected));

        // assert
        $actual->assertRecorded([new RecordCreated($expected['merchant_id'], $expected['from'], $expected['time'])]);
    }
}
