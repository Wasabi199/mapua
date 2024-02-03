<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserContribution extends Model
{
    use HasFactory;
    protected $fillable=[
        'contribution_amount'
    ];

    public function users(){
        return $this->hasOne(User::class);
    }

    public function contributionHistory():HasMany
    {
        return $this->hasMany(ContributionHistory::class);
    }
}
