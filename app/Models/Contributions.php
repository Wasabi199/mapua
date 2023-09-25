<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributions extends Model
{
    use HasFactory;
    protected $fillable =[
        'contribution_amount',
        // 'date'
    ];
    // public function user(){
    //     return $this->belongsTo(User::class);
    // }
    public function loans(){
        return $this->belongsTo(Loans::class);
    }
    
}


