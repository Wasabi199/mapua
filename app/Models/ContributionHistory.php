<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContributionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount'
    ];


    public function userContributions():BelongsTo
    {
        return $this->belongsTo(UserContribution::class);
    }
    
}
