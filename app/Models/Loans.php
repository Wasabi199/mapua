<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    use HasFactory;
    protected $fillable=[

        'loan_type',    
        'loan_amount',  
        'amount',
        'interest',
        'approval',
        'duration',
        'loan_status',
        
        'attachment1',
        'attachment2',
        'attachment3',
        'attachment4',
        'reason',
        
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function contributions(){
        return $this->hasMany(Contributions::class);
    }



    // filters
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['approval'] ?? null, function ($query, $approval) {
            $query->where('approval','=', $approval);
        })->where('loan_amount','>',0);
    }

    public function scopeFilterOwner($query,$id){
        $query->when($id ?? null, function($query, $id){
            $query->where('user_id','=',$id);
        });
    }

}
