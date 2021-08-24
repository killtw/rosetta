<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMerchantRequest;
use App\Http\Resources\MerchantResource;
use App\Services\MerchantService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MerchantController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CreateMerchantRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMerchantRequest $request): JsonResponse
    {
        $merchant = app(MerchantService::class)->create($request->only(['name', 'phone', 'identity', 'location', 'address']));

        return (new MerchantResource($merchant))->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
