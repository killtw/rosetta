<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecordRequest;
use App\Http\Requests\SearchRecordRequest;
use App\Http\Resources\RecordSearchCollection;
use Domain\Record\RecordService;
use Illuminate\Http\JsonResponse;
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

    /**
     * @param \App\Http\Requests\SearchRecordRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(SearchRecordRequest $request): JsonResponse
    {
        $result = app(RecordService::class)->search(data_get($request, 'merchant_id'), data_get($request, 'time'));

        return (new RecordSearchCollection($result))->response();
    }
}
