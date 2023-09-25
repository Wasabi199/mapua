<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserNotifications extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'universal_id',
        'onRead',
        'value',
        'type',
        'notification_type',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, $user_type){
        $query->when($user_type ?? null, function($query, $user_type){
            $query->where('type',$user_type);
        });
    }
    public function scopeFilterOwner($query, $user_type){
        $query->when($user_type ?? null, function($query, $user_type){
            $query->where('type',$user_type)
                ->where('user_id',auth()->id());
        });
    }
}
