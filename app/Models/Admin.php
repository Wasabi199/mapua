<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [

        'first_name',
        'middle_name',
        'last_name',
        'mobile_number',
        'birth_date',
        'birth_place',
        'civil_status',


        // 'region',
        // 'province',
        // 'municipality',
        // 'barangay',
        // 'current_address',

        'department',
        'salary',
        'membership',
        'employment',
        // 'total_contribution'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
