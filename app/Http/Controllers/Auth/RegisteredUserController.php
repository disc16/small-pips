<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\CapitalAndRiskMgmt;
use App\Models\MarketInformation;
use App\Models\TradingStrategy;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole(['User', 'Basic']);

        $this->create_user_data($user);

        event(new Registered($user));

        Auth::login($user);

        // return redirect(route('dashboard', absolute: false));
        return redirect(route('afterRegistrationSettings', absolute: false));
    }

    public function create_user_data($user) {
        \Log::info(var_export($user->id, true));

        $capital = new CapitalAndRiskMgmt;
        $capital->user_id = $user->id;
        $capital->trading_account = 'Default';
        $capital->capital = 2000;
        $capital->risk_percentage = 0.25;
        $capital->risk_amount = 50;
        $capital->targets = json_encode([
            'target1' => [
                'rrr' => 1.5,
                'pips' => 35,
                'min_pips' => 26
            ],
            'target2' => [
                'rrr' => 2.0,
                'pips' => 25,
                'min_pips' => 16
            ],
            'target3' => [
                'rrr' => 2.5,
                'pips' => 15,
                'min_pips' => 0
            ]
        ]);
        $capital->save();


        // CapitalAndRiskMgmt::create([
        //     'user_id' => $user->id,
        //     'trading_account' => 'Default',
        //     'capital' => 2000,
        //     'risk_percentage' => 0.025,
        //     'risk_amount' => 50,
        //     'targets' => json_encode([
        //         'target1' => [
        //             'rrr' => 1.5,
        //             'pips' => 35,
        //             'min_pips' => 26
        //         ],
        //         'target2' => [
        //             'rrr' => 2.0,
        //             'pips' => 25,
        //             'min_pips' => 16
        //         ],
        //         'target3' => [
        //             'rrr' => 2.5,
        //             'pips' => 15,
        //             'min_pips' => 0
        //         ]
        //     ])
        // ]);

        MarketInformation::create([
            'user_id' => $user->id,
            // 'account_type' => 'Basic',
            'account_type_id' => 1,
            'currency_id' => 8
        ]);

        $market = new MarketInformation;
        $market->user_id = $user->id;
        $market->account_type_id = 1;
        $market->currency_id = 8;
        $market->save();

        $this->seedStrategy($user->id);
    }

    public function seedStrategy($id)
    {
        $trade = new TradingStrategy;
        $trade->user_id = $id;
        $trade->strategy = 'Momentum - Slingshot';
        $trade->type = 'Trend Following';
        $trade->save();

        $trade = new TradingStrategy;
        $trade->user_id = $id;
        $trade->strategy = 'Momentum - Boomers';
        $trade->type = 'Trend Following';
        $trade->save();

        $trade = new TradingStrategy;
        $trade->user_id = $id;
        $trade->strategy = 'Swing - Pullback';
        $trade->type = 'Trend Following';
        $trade->save();

        $trade = new TradingStrategy;
        $trade->user_id = $id;
        $trade->strategy = 'Swing - Range';
        $trade->type = 'Trend Following';
        $trade->save();

        $trade = new TradingStrategy;
        $trade->user_id = $id;
        $trade->strategy = 'Position - Coils';
        $trade->type = 'Waiting Game';
        $trade->save();

        $trade = new TradingStrategy;
        $trade->user_id = $id;
        $trade->strategy = 'Position - Bluesky';
        $trade->type = 'Waiting Game';
        $trade->save();

        $trade = new TradingStrategy;
        $trade->user_id = $id;
        $trade->strategy = 'Capitulation - Reversal';
        $trade->type = 'Counter Trading';
        $trade->save();

        $trade = new TradingStrategy;
        $trade->user_id = $id;
        $trade->strategy = 'Capitulation - Retest';
        $trade->type = 'Counter Trading';
        $trade->save();





    }

}
