<?php

namespace App\Http\Controllers;

use App\Models\TradingStrategy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TradingStrategyController extends Controller
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
        $data = new TradingStrategy;
        $data->user_id = auth()->user()->id;
        $data->strategy = $request->strategy;
        $data->type = $request->type;
        $data->save();

        $user = User::with('marketInformation.accountType', 'tradingStrategies')->where('id', auth()->user()->id)->first();
        $strategies = TradingStrategy::where('user_id', auth()->user()->id)->get();

        return Redirect::route('trade-settings.edit', [
            'user' => $user,
            'strategies' => $strategies
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(TradingStrategy $tradingStrategy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TradingStrategy $tradingStrategy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TradingStrategy $tradingStrategy)
    {
        $data = TradingStrategy::where('id', $request->id)->first();
        $data->strategy = $request->strategy;
        $data->type = $request->type;
        $data->save();

        $user = User::with('marketInformation.accountType', 'tradingStrategies')->where('id', auth()->user()->id)->first();
        $strategies = TradingStrategy::where('user_id', auth()->user()->id)->get();

        return Redirect::route('trade-settings.edit', [
            'user' => $user,
            'strategies' => $strategies
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TradingStrategy $tradingStrategy)
    {
        //
    }
}
