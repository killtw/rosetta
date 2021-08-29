<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecordRequest;
use App\Models\Record;
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
        Record::create([
            'uuid' => Str::uuid(),
            'merchant_id' => data_get($request->all(), 'merchant_id'),
            'from' => data_get($request->all(), 'from'),
            'time' => $request->get('time'),
        ]);

        return response()->json(['message' => 'success'])->setStatusCode(Response::HTTP_CREATED);
    }
}
