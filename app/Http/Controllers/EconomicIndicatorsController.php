<?php

namespace App\Http\Controllers;

use App\Models\EconomicIndicators;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class EconomicIndicatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $indicators = EconomicIndicators::all();

        return Inertia::render('Admin/TradingIndicators', [
            'indicators' => $indicators
        ]);
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
        $data = new EconomicIndicators;
        $data->name = $request->name;
        $data->group = $request->group;
        $data->save();


        return Redirect::route('indicators.index', [
            'indicators' => EconomicIndicators::all(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(EconomicIndicators $economicIndicators)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EconomicIndicators $economicIndicators)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EconomicIndicators $economicIndicators)
    {
        $data = EconomicIndicators::where('id', $request->id)->first();
        $data->name = $request->name;
        $data->group = $request->group;
        $data->save();

        return Redirect::route('indicators.index', [
            'indicators' => EconomicIndicators::all(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EconomicIndicators $economicIndicators)
    {
        //
    }
}
