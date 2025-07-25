<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use LaravelAndVueJS\Traits\LaravelPermissionToVueJS;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, LaravelPermissionToVueJS;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userPerson():hasOne
    {
        return $this->hasOne(UserPerson::class);
    }

    public function tradeRecords():hasMany
    {
        return $this->hasMany(TradeRecords::class);
    }

    public function tradingStrategies():hasMany
    {
        return $this->hasMany(TradingStrategy::class);
    }

    public function marketInformation():hasOne
    {
        return $this->hasOne(MarketInformation::class);
    }

    public function capitalAndRiskMgmt():hasOne
    {
        return $this->hasOne(CapitalAndRiskMgmt::class);
    }

    public function accountType():belongsTo
    {
        return $this->belongsTo(AccountType::class);
    }
}
