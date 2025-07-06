<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SheetDB\SheetDB;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\FMPSheet;
use App\Models\CurrencyPriceToday;
use App\Models\CurrencyPriceAll;
use App\Models\TickerPair;

use Carbon\Carbon;

class FMPSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->saveCurrencyPriceToday();

        return Inertia::render('Source/FMP', $data);
    }

    public function saveCurrencyPriceToday() {
        \Log::info('saving currency pair price');
        
        
        $pairs = TickerPair::where('market_type', 'FOREX')->get();
        $countToday = 0;
        $countAll = 0;

        foreach ($pairs as $key => $value) {
            $base = substr($value->ticker, 0, 3);
            $qoute = substr($value->ticker, 3);
            $fmpData = FMPSheet::where('ticker_pair', $value->ticker)->get();
            // \Log::info('wopoooooo   '. $value->ticker);
            // \Log::info(var_export($fmpData[0], true));
            $origPair = $fmpData ? 1 : 0;
            $jpyPair = str_contains($value->ticker, 'JPY');
            $closePrice = $this->closePrice($value, $fmpData[0], $origPair, $jpyPair);
            $prevClose = CurrencyPriceAll::where('ticker_pair', $value->ticker)->whereDate("created_at", Carbon::yesterday()->format('Y-m-d'))->first();
            $prevClose = $prevClose ? $prevClose : 0;

            \Log::info('-->>>');
            \Log::info($closePrice);
            \Log::info($prevClose);
            $percentChange = $prevClose ? ($closePrice ? ($closePrice / $prevClose) : 0) : 1;

            // Before update check if source date is new day
            $latestToday = CurrencyPriceToday::latest('id')->first();
            if($latestToday != null && Carbon::today() > Carbon::parse($latestToday['date']))
            {
                \Log::info('Saving to currency price all');
                // So if new day, then add data to CurrencyPriceAll

                // Do another check if ticker and date already exist. To avoid multiple inputs
                $checkDateData = CurrencyPriceAll::where('ticker_pair', $value->ticker)->where('date', Carbon::today()->format('Y-m-d'))->first();
                if($checkDateData === null)
                {
                    $this->saveCurrencyPriceAll($value, $fmpData, $base, $qoute, $origPair, $jpyPair, $closePrice, $prevClose, $percentChange);
                    $countAll++;
                }

                
            }

            $data = CurrencyPriceToday::where('ticker_pair', $value->ticker)->first();
            \Log::info('Now saving to price today');
            \Log::info($closePrice);
            // \Log::info(var_export($data, true));
            if($data === null)
            {
                \Log::info('is null');
                $data = new CurrencyPriceToday;
            }
            
            $data->date = Carbon::today()->format('Y-m-d');
            $data->base_currency = $base;
            $data->qoute_currency = $qoute;
            $data->ticker_pair = $value->ticker;
            $data->right_pair = "$qoute$base";
            $data->orig_pair = $origPair ? 'yes' : 'no';
            $data->jpy_pair = $jpyPair ? 'yes' : 'no';
            $data->close_price = $closePrice;
            $data->prev_close = $prevClose;
            $data->percent_change = $percentChange;
            $data->prev_date = Carbon::yesterday()->format('Y-m-d');
            $data->open_price = $this->openPrice($value, $fmpData[0], $origPair, $jpyPair);
            $data->high_price = $this->highPrice($value, $fmpData[0], $origPair, $jpyPair);
            $data->low_price = $this->lowPrice($value, $fmpData[0], $origPair, $jpyPair);
            $data->close_price_2 = $closePrice;
            $data->save();
            $countToday++;

        }

        $todayData = CurrencyPriceToday::get();
        $allData = CurrencyPriceAll::get();

        return [
            'today' => $countToday, 
            'all' => $countAll,
            'todayData' => $todayData,
            'allData' => $allData
        ];
    }

    public function saveCurrencyPriceAll($value, $fmpData, $base, $qoute, $origPair, $jpyPair, $closePrice, $prevClose, $percentChange)
    {
        $dataAll = new CurrencyPriceAll;
        $dataAll->date = Carbon::today()->format('Y-m-d');
        $dataAll->base_currency = $base;
        $dataAll->qoute_currency = $qoute;
        $dataAll->ticker_pair = $value->ticker;
        $dataAll->right_pair = "$qoute$$base";
        $dataAll->orig_pair = $origPair ? 'yes' : 'no';
        $dataAll->jpy_pair = $jpyPair ? 'yes' : 'no';
        $dataAll->close_price = $closePrice;
        $dataAll->prev_close = $prevClose;
        $dataAll->percent_change = $percentChange;
        $dataAll->prev_date = Carbon::yesterday()->format('Y-m-d');
        $dataAll->open_price = $this->openPrice($value, $fmpData[0], $origPair, $jpyPair);
        $dataAll->high_price = $this->highPrice($value, $fmpData[0], $origPair, $jpyPair);
        $dataAll->low_price = $this->lowPrice($value, $fmpData[0], $origPair, $jpyPair);
        $dataAll->close_price_2 = $closePrice;
        $dataAll->save();
    }

    public function closePrice($value, $fmp, $orig, $jpy) {
        \Log::info('>> close price');
        \Log::info($fmp);

        if($orig)
        {
            if($jpy)
            {
                return floatval($fmp->bid) / 100;
            }
            else
            {
                return floatval($fmp->bid);
            }
        }
        else
        {
            if($jpy)
            {
                return 1 / (floatval($fmp->bid) / 100);
            }
            else
            {
                return 1 / floatval($fmp->bid);
            }
        }
    }

    public function openPrice($value, $fmp, $orig, $jpy) {

        if($orig)
        {
            if($jpy)
            {
                return floatval($fmp->open) / 100;
            }
            else
            {
                return floatval($fmp->open);
            }
        }
        else
        {
            if($jpy)
            {
                return 1 / (floatval($fmp->open) / 100);
            }
            else
            {
                return 1 / floatval($fmp->open);
            }
        }
    }

    public function highPrice($value, $fmp, $orig, $jpy) {

        if($orig)
        {
            if($jpy)
            {
                return floatval($fmp->high) / 100;
            }
            else
            {
                return floatval($fmp->high);
            }
        }
        else
        {
            if($jpy)
            {
                return 1 / (floatval($fmp->high) / 100);
            }
            else
            {
                return 1 / floatval($fmp->high);
            }
        }
    }

    public function lowPrice($value, $fmp, $orig, $jpy) {

        if($orig)
        {
            if($jpy)
            {
                return floatval($fmp->low) / 100;
            }
            else
            {
                return floatval($fmp->low);
            }
        }
        else
        {
            if($jpy)
            {
                return 1 / (floatval($fmp->low) / 100);
            }
            else
            {
                return 1 / floatval($fmp->low);
            }
        }
    }

}
