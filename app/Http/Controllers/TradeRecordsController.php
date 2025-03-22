<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTradeRecordsRequest;
use App\Http\Requests\UpdateTradeRecordsRequest;
use App\Models\TradeRecords;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\TickerPair;
use App\Models\CapitalAndRiskMgmt;
use App\Models\TradingStrategy;
use App\Models\TradingTime;
use Carbon\Carbon;


class TradeRecordsController extends Controller
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
    public function store(StoreTradeRecordsRequest $request)
    {
        \Log::info(var_export($request->entry_date, true));
        \Log::info(var_export($request->all(), true));

        $entry_time_id = $this->getTradingTime($request->entry_time);

        $record = new TradeRecords;
        $record->user_id = $request->user_id;
        $record->ticker_id = $request->ticker;
        $record->entry_date = $request->entry_date;
        $record->entry_time = Carbon::createFromFormat('H:i',$request->entry_time)->toTimeString();
        $record->entry_time_id = $entry_time_id;
        $record->order_type = $request->order_type;
        $record->position = $request->position;
        $record->stock_sentiment = $request->stock_sentiment;

        $record->acct_curr_pair_price = $request->acct_curr_pair_price;
        $record->trading_strategy_id = $request->analysis;
        $record->trade_sentiment = $request->trade_sentiment;
        
        
        $record->entry_price = $request->entry_price;
        $record->stop_price = $request->stop_price;
        $record->manual_risk_value = $request->manual_risk_value;
        $record->lots = $request->lots;
        $record->risk_value = $request->risk_value;
        $record->targets = json_encode([
            'target_reco' => $request->target_reco,
            'target_price_1' => $request->target_price_1,
            'target_price_2' => $request->target_price_2,
            'target_price_3' => $request->target_price_3,
            'percent_control' => $request->percent_control
        ]);

        $record->open_chart = $request->open_chart;
        $record->exit_chart = $request->exit_chart;
        $record->note = $request->note;
        $record->session = $request->session;


        $record->save();
        // $record->save($request->all());

        // $user = auth()->user();
        // $entries = TradeRecords::with('tickerPair', 'currencyPrice')->where('user_id', auth()->user()->id)->get();
        // $tickers = TickerPair::all();
        // $strategies = TradingStrategy::where('user_id', auth()->user()->id)->get();
        // $capital = CapitalAndRiskMgmt::where('user_id', auth()->user()->id)->first();

        return Inertia::render('TradeRecords/Entries', $this->getRecordsOverview());
    }

    /**
     * Display the specified resource.
     */
    public function show(TradeRecords $tradeRecords)
    {
        // $tickers = TickerPair::all();
        // $entries = TradeRecords::with('tickerPair', 'currencyPrice')->where('user_id', auth()->user()->id)->get();
        // $strategies = TradingStrategy::where('user_id', auth()->user()->id)->get();
        // $capital = CapitalAndRiskMgmt::where('user_id', auth()->user()->id)->first();


        // \Log::info('waaaa', var_export($strategies));
        \Log::info(var_export(auth()->user()->id, true));

        return Inertia::render('TradeRecords/Entries', $this->getRecordsOverview());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TradeRecords $tradeRecords)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTradeRecordsRequest $request, TradeRecords $tradeRecords)
    {
        $entryTimeId = $this->getTradingTime($request->entry_time);
        $actualExitTimeId = $this->getTradingTime($request->actual_exit_time);
        $systemExitTimeId = $this->getTradingTime($request->system_exit_time);

        \Log::info('Updateeeee ');
        \Log::info(var_export($request->id, true));
        // $record = new TradeRecords;
        $tradeRecords = TradeRecords::where('id', $request->id)->first();
        $tradeRecords->user_id = $request->user_id;
        $tradeRecords->ticker_id = $request->ticker;
        $tradeRecords->entry_date = $request->entry_date;
        $tradeRecords->entry_time = Carbon::createFromFormat('H:i',$request->entry_time)->toTimeString();
        $tradeRecords->entry_time_id = $entryTimeId;
        $tradeRecords->order_type = $request->order_type;
        $tradeRecords->position = $request->position;
        $tradeRecords->stock_sentiment = $request->stock_sentiment;

        $tradeRecords->acct_curr_pair_price = $request->acct_curr_pair_price;
        $tradeRecords->trading_strategy_id = $request->analysis;
        $tradeRecords->trade_sentiment = $request->trade_sentiment;
        
        $tradeRecords->entry_price = $request->entry_price;
        $tradeRecords->stop_price = $request->stop_price;
        $tradeRecords->manual_risk_value = $request->manual_risk_value;
        $tradeRecords->lots = $request->lots;
        $tradeRecords->risk_value = $request->risk_value;
        $tradeRecords->targets = json_encode([
            'target_reco' => $request->target_reco,
            'target_price_1' => $request->target_price_1,
            'target_price_2' => $request->target_price_2,
            'target_price_3' => $request->target_price_3,
            'percent_control' => $request->percent_control
        ]);

        $tradeRecords->open_chart = $request->open_chart;
        $tradeRecords->exit_chart = $request->exit_chart;
        $tradeRecords->note = $request->note;
        $tradeRecords->session = $request->session;

        // Actual Exit Data
        $tradeRecords->actual_exit_date = $request->actual_exit_date;
        $tradeRecords->actual_exit_time = Carbon::createFromFormat('H:i',$request->actual_exit_time)->toTimeString();
        $tradeRecords->actual_exit_time_id = $actualExitTimeId;
        $tradeRecords->actual_exit_price = $request->actual_exit_price;
        $tradeRecords->actual_profit_loss = $request->actual_profit_loss;
        $tradeRecords->actual_actual_profit_loss = $request->actual_actual_profit_loss;
        $tradeRecords->actual_status = $request->actual_status;
        $tradeRecords->actual_holding_period = $request->actual_holding_period;
        $tradeRecords->actual_percent_profit_loss = $request->actual_percent_profit_loss;
        $tradeRecords->actual_reward_ratio = $request->actual_reward_ratio;
        $tradeRecords->actual_remarks = $request->actual_remarks;

        // System Exit Data
        $tradeRecords->system_exit_date = $request->system_exit_date;
        $tradeRecords->system_exit_time = Carbon::createFromFormat('H:i',$request->system_exit_time)->toTimeString();
        $tradeRecords->system_exit_time_id = $systemExitTimeId;
        $tradeRecords->system_exit_price = $request->system_exit_price;
        $tradeRecords->system_profit_loss = $request->system_profit_loss;
        $tradeRecords->system_actual_profit_loss = $request->system_actual_profit_loss;
        $tradeRecords->system_status = $request->system_status;
        $tradeRecords->system_holding_period = $request->system_holding_period;
        $tradeRecords->system_percent_profit_loss = $request->system_percent_profit_loss;
        $tradeRecords->system_reward_ratio = $request->system_reward_ratio;
        $tradeRecords->reason = $request->reason;

        $tradeRecords->save();

        // $user = auth()->user();
        // $entries = TradeRecords::with('tickerPair', 'currencyPrice')->where('user_id', auth()->user()->id)->get();
        // $tickers = TickerPair::all();
        // $strategies = TradingStrategy::where('user_id', auth()->user()->id)->get();
        // $capital = CapitalAndRiskMgmt::where('user_id', auth()->user()->id)->first();

        return Inertia::render('TradeRecords/Entries', $this->getRecordsOverview());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TradeRecords $tradeRecords)
    {
        //
    }

    /**
    * Get Entry time base on Entry time table
    */
    public function getTradingTime($time)
    {   
        $data = TradingTime::all()->toArray();
        $entry_time = Carbon::createFromFormat('H:i',$time);
        $db_time = null;

        foreach ($data as $key => $value) {
            $datetime = Carbon::createFromFormat('H:i:s', $value['ph_time']);

            // if(Carbon::parse($entry_time)->gt(Carbon::parse($datetime)))
            if($entry_time->gt($datetime))
            {
                if($db_time)
                {
                    // \Log::info('wooooooo .'.$db_time);
                    if(Carbon::createFromFormat('H:i:s', $db_time['ph_time'])->lt($datetime))
                    {
                        $db_time = $value;
                    }
                }
                else
                {
                    $db_time = $value;
                }
            }
        }

        return $db_time['id'];
    }

    /**
     * Get Data for Records overview
     */

     public function getRecordsOverview() {
        $user = auth()->user();
        $entries = TradeRecords::with('tickerPair', 'currencyPrice')->where('user_id', auth()->user()->id)->latest()->paginate(10);
        $tickers = TickerPair::all();
        $strategies = TradingStrategy::where('user_id', auth()->user()->id)->get();
        $capital = CapitalAndRiskMgmt::where('user_id', auth()->user()->id)->first();
        $tradingTime = TradingTime::get();

        return [
            'user' => auth()->user()->load(['marketInformation', 'tradingStrategies', 'capitalAndRiskMgmt']),
            'entries' => $entries,
            'tickers' => $tickers,
            'capital' => $capital,
            'strategies' => $strategies,
            'tradingTime' => $tradingTime
        ];
     }
}
