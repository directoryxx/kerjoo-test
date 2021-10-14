<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permit\ListPermitRequest;
use App\Http\Requests\Permit\StorePermitRequest;
use App\Http\Resources\PermitResource;
use App\Permit;
use App\Services\PermitService;

class PermitController extends Controller
{
    protected $permitService;

    public function __construct(PermitService $permitService)
    {
        $this->permitService = $permitService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListPermitRequest $request)
    {
        $permit = $this->permitService->getPermits($request->only(['page', 'limit']));

        $permit->load('user');

        return PermitResource::collection($permit);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermitRequest $request)
    {
        $permit = $this->permitService->createPermit($request->only(['user_id','submission_date','reason']));
        return new PermitResource($permit);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permit  $permit
     * @return \Illuminate\Http\Response
     */
    public function show(Permit $permit)
    {
        $permit = $this->permitService->getPermit($permit->id);

        $permit->load('user');

        return new PermitResource($permit);
    }

}
