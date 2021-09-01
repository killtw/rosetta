<?php

namespace Tests\Feature;

use App\Models\Merchant;
use App\Models\Record;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RecordsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_create_and_return_a_record()
    {
        // arrange
        $merchant = Merchant::factory()->create();
        $expected = [
            'time' => '2021-01-01T00:00:00',
            'from' => '0912345678',
            'text' => '場所代碼：0000 0000 0000 001\n本簡訊是簡訊實聯制發送，限防疫目的使用',
        ];

        // act
        $actual = $this->postJson(route('records.store'), $expected);

        // assert
        $actual
            ->assertCreated()
            ->assertJson([
                'message' => 'success',
            ]);
        $this->assertDatabaseHas('records', [
            'merchant_id' => $merchant->id,
            'from' => $expected['from'],
            'time' => Carbon::parse($expected['time'])->utc(),
        ]);
    }

    /** @test */
    public function it_should_accept_different_format_of_phone_number()
    {
        // arrange
        $merchant = Merchant::factory()->create();
        $expected = [
            'time' => '2021-01-01T00:00:00',
            'from' => '0912-345-678',
            'text' => '場所代碼：0000 0000 0000 001\n本簡訊是簡訊實聯制發送，限防疫目的使用',
        ];

        // act
        $actual = $this->postJson(route('records.store'), $expected);

        // assert
        $actual
            ->assertCreated()
            ->assertJson([
                'message' => 'success',
            ]);
        $this->assertDatabaseHas('records', [
            'merchant_id' => $merchant->id,
            'from' => '0912345678',
            'time' => Carbon::parse($expected['time'])->utc(),
        ]);
    }

    /** @test */
    public function it_should_accept_another_format_of_phone_number()
    {
        // arrange
        $merchant = Merchant::factory()->create();
        $expected = [
            'time' => '2021-01-01T00:00:00',
            'from' => '(+886)912345678',
            'text' => '場所代碼：0000 0000 0000 001\n本簡訊是簡訊實聯制發送，限防疫目的使用',
        ];

        // act
        $actual = $this->postJson(route('records.store'), $expected);

        // assert
        $actual
            ->assertCreated()
            ->assertJson([
                'message' => 'success',
            ]);
        $this->assertDatabaseHas('records', [
            'merchant_id' => $merchant->id,
            'from' => '0912345678',
            'time' => Carbon::parse($expected['time'])->utc(),
        ]);
    }

    /** @test */
    public function it_should_return_error_when_format_of_phone_is_not_valid()
    {
        // arrange
        Merchant::factory()->create();
        $expected = [
            'time' => '2021-01-01T00:00:00',
            'from' => '912345678',
            'text' => '場所代碼：0000 0000 0000 001\n本簡訊是簡訊實聯制發送，限防疫目的使用',
        ];

        // act
        $actual = $this->postJson(route('records.store'), $expected);

        // assert
        $actual
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'The given data was invalid.',
            ])
            ->assertJsonValidationErrors([
                'from' => 'from 不是合法的手機號碼',
            ]);
    }

    /** @test */
    public function it_should_return_error_when_text_does_not_contain_merchant_number()
    {
        // arrange
        Merchant::factory()->create();
        $expected = [
            'time' => '2021-01-01T00:00:00',
            'from' => '0912345678',
            'text' => '場所代碼：0000 0000\n本簡訊是簡訊實聯制發送，限防疫目的使用',
        ];

        // act
        $actual = $this->postJson(route('records.store'), $expected);

        // assert
        $actual
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'The given data was invalid.',
            ])
            ->assertJsonValidationErrors([
                'text' => 'text 沒有包含場所代碼',
            ]);
    }

    /** @test */
    public function it_should_return_success_when_text_contain_multiple_merchant_numbers()
    {
        // arrange
        Merchant::factory()->create();
        $expected = [
            'time' => '2021-01-01T00:00:00',
            'from' => '0912345678',
            'text' => '場所代碼：0000 0000 0000 001\n分店代號 2222 2222 2222 222\n本簡訊是簡訊實聯制發送，限防疫目的使用',
        ];

        // act
        $actual = $this->postJson(route('records.store'), $expected);

        // assert
        $actual
            ->assertCreated()
            ->assertJson([
                'message' => 'success',
            ]);
    }

    /** @test */
    public function it_should_return_errors_when_merchant_number_is_not_exist()
    {
        // arrange
        Merchant::factory()->create();
        $expected = [
            'time' => '2021-01-01T00:00:00',
            'from' => '0912345678',
            'text' => '場所代碼：0000 0000 0000 101\n本簡訊是簡訊實聯制發送，限防疫目的使用',
        ];

        // act
        $actual = $this->postJson(route('records.store'), $expected);

        // assert
        $actual
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'The given data was invalid.',
            ])
            ->assertJsonValidationErrors([
                'text' => 'text 包含的場所代碼不存在',
            ]);
    }

    /** @test */
    public function it_should_return_records_before_time_from_merchant()
    {
        // arrange
        Redis::command('flushall');
        $merchant = Merchant::factory()->create();
        $time = now();
        $expected = [];
        for ($i = 0; $i < 10; $i++) {
            $expected[] = Record::factory()->create(['merchant_id' => $merchant->id, 'time' => $time])->from;
            $time->addHour();
        }
        $record = Record::factory()->create(['merchant_id' => $merchant->id, 'time' => $time]);
        $expected[] = $record->from;
        $data = [
            'merchant' => str_pad($record->merchant_id, 15, 0, STR_PAD_LEFT),
            'time' => $record->time->format('Y-m-d H:i:s'),
        ];

        // act
        $actual = $this->postJson(route('records.search'), $data);

        // assert
        $this->assertEquals($expected, $actual->json('data.*.from'));
    }
}
