<?php

namespace Tests\Unit\Record;

use App\Models\Merchant;
use Domain\Record\RecordService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class RecordServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_create_a_record()
    {
        // arrange
        $merchant = Merchant::factory()->create();
        $expected = [
            'merchant_id' => $merchant->id,
            'from' => '0912345678',
            'time' => '2021-01-01T00:00:00',
        ];

        // act
        $actual = app(RecordService::class)->create($expected);

        // assert
        $this->assertDatabaseHas('records', [
            'merchant_id' => $merchant->id,
            'from' => $expected['from'],
            'time' => Carbon::parse($expected['time'])->utc(),
        ]);
    }
}
