<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use App\Models\Currency;
use App\Models\AccountType;
use App\Models\CapitalAndRiskMgmt;
use App\Models\TradingStrategy;

class TradeSettingsController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $user = User::with('marketInformation.accountType', 'tradingStrategies')->where('id', auth()->user()->id)->first();
        $currencies = Currency::get();
        $accounts = AccountType::get();
        $capitals = CapitalAndRiskMgmt::where('user_id', auth()->user()->id)->get();
        $strategies = TradingStrategy::where('user_id', auth()->user()->id)->get();
        // $request->user()->marketInformation;

        return Inertia::render('TradeSettings/Edit', [
            'user' => $user,
            'currencies' => $currencies,
            'accounts' => $accounts,
            'capitals' => $capitals,
            'strategies' => $strategies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
