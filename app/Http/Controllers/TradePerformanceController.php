<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTradePerformanceRequest;
use App\Http\Requests\UpdateTradePerformanceRequest;
use App\Models\TradePerformance;
use Inertia\Inertia;
use Inertia\Response;


class TradePerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTradePerformanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TradePerformance $tradePerformance)
    {
        return Inertia::render('TradeRecords/TradePerformance', []);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TradePerformance $tradePerformance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTradePerformanceRequest $request, TradePerformance $tradePerformance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TradePerformance $tradePerformance)
    {
        //
    }
}
