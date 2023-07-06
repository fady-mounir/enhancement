<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Store\Models\Store;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'password',
        'store_name',
        'email_verified_at',
        'is_verified',
        'allow_2fa',
        'status',
        'google2fa_secret',
        'role',
        'type',
        'temp_password',
        'temp_email',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'google2fa_secret'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends= [
        'avatar',
    ];

    ///////////////// Accessors //////////////////////
    public function getAvatarAttribute(): string
    {
        return $this->getFirstMediaUrl('avatar')  ;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name." ".$this->last_name;
    }

    ////////////// Relations ///////////////////////
    public function verify()
    {
        return $this->hasOne(Verification::class, 'user_id');
    }
    public function store()
    {
        return $this->hasOne(Store   ::class, 'owner_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id');
    }

    public function scheduledSubscriptions()
    {
        return $this->hasMany(SubscriptionSchedule::class, 'user_id');
    }

    public function notStartedScheduledSubscriptions()
    {
        return $this->hasMany(SubscriptionSchedule::class, 'user_id')->where("status","not_started")->first();
    }
}
