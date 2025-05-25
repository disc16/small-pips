<?php

namespace App\Http\Controllers;

use App\Models\CapitalAndRiskMgmt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CapitalAndRiskMgmtController extends Controller
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
        \Log::info('Capital and Risk Mgmt Store');
        \Log::info(var_export($request->trading_account, true));
        $data = new CapitalAndRiskMgmt;

        $data->capital = $request->capital;
        $data->user_id = auth()->user()->id;
        $data->trading_account = $request->trading_account;
        $data->risk_percentage = (float) $request->risk_percentage;
        $data->risk_amount = $request->risk_amount;
        $data->targets = json_encode([
            'target1' => [
                'rrr' => $request->target1_rrr,
                'pips' => $request->target1_pips,
                'min_pips' => $request->target1_min_pips
            ],
            'target2' => [
                'rrr' => $request->target1_rrr,
                'pips' => $request->target2_pips,
                'min_pips' => $request->target2_min_pips
            ],
            'target3' => [
                'rrr' => $request->target1_rrr,
                'pips' => $request->target3_pips,
                'min_pips' => $request->target3_min_pips
            ]
        ]);
        $data->save();

        \Log::info('heeeey');

        $capitals = CapitalAndRiskMgmt::where('user_id', auth()->user()->id)->get();

        return Redirect::route('trade-settings.edit', [
            'capitals' => $capitals
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CapitalAndRiskMgmt $capitalAndRiskMgmt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CapitalAndRiskMgmt $capitalAndRiskMgmt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CapitalAndRiskMgmt $capitalAndRiskMgmt)
    {
        $data = CapitalAndRiskMgmt::where('id', $request->id)->first();
        $data->trading_account = $request->trading_account;
        $data->risk_percentage = (float) $request->risk_percentage;
        $data->risk_amount = $request->risk_amount;
        $data->targets = json_encode([
            'target1' => [
                'rrr' => $request->target1_rrr,
                'pips' => $request->target1_pips,
                'min_pips' => $request->target1_min_pips
            ],
            'target2' => [
                'rrr' => $request->target2_rrr,
                'pips' => $request->target2_pips,
                'min_pips' => $request->target2_min_pips
            ],
            'target3' => [
                'rrr' => $request->target3_rrr,
                'pips' => $request->target3_pips,
                'min_pips' => $request->target3_min_pips
            ]
        ]);

        $data->save();

        $capitals = CapitalAndRiskMgmt::where('user_id', auth()->user()->id)->get();

        return Redirect::route('trade-settings.edit', [
            'capitals' => $capitals
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CapitalAndRiskMgmt $capitalAndRiskMgmt)
    {
        //
    }
}
