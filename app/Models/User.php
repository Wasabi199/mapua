<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'userType',
        'member_id',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

 

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected static function booted(){
        static::created(function($user){
            $user->userContribution()->create();
        });
        static::deleted(function ($user){
            $user->adminReg()->delete();
            $user->loans()->delete();
            $user->medicals()->delete();
            $user->userNotif()->delete();
        });
        static::restored(function($user){
            $user->adminReg()->restore();
            $user->loans()->restore();
            $user->medicals()->restore();
            $user->userNotif()->restore();
        });
    }

// Relationships
    public function adminReg(){
        return $this->hasOne(Admin::class);
    }
    public function loans(){
        return $this->hasMany(Loans::class,"user_id");
    }

    public function medicals(){
        return $this->hasMany(Medical::class);
    }
    
    public function userNotif(){
        return $this->hasMany(UserNotifications::class)->latest();
    }
    public function userContribution(){
        return $this->hasOne(UserContribution::class);
    }

    // Filters

    public function scopeFilter($query, array $filters)
    {
        $query->where('status',1)->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            });
        });
    }
}
