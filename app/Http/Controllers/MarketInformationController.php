<?php

namespace App\Http\Controllers;

use App\Models\MarketInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MarketInformationController extends Controller
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
    public function show(MarketInformation $marketInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MarketInformation $marketInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MarketInformation $marketInformation)
    {
        //
        \Log::info(var_export($request->account_type, true));
        \Log::info(auth()->user()->id);

        $data = MarketInformation::where('user_id', auth()->user()->id)->first();
        $data->account_type_id = $request->account_type;
        $data->currency_id = $request->currency;
        $data->save();

        return Redirect::route('trade-settings.edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MarketInformation $marketInformation)
    {
        //
    }
}
