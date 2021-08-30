<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecordRequest;
use App\Models\Record;
use Domain\Records\RecordService;
use Illuminate\Http\JsonResponse;
use Str;
use Symfony\Component\HttpFoundation\Response;

class RecordController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CreateRecordRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateRecordRequest $request): JsonResponse
    {
        app(RecordService::class)->create($request->only(['merchant_id', 'from', 'time']));

        return response()->json(['message' => 'success'])->setStatusCode(Response::HTTP_CREATED);
    }
}
