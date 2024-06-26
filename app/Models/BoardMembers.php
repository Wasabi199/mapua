<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardMembers extends Model
{
    use HasFactory;
    protected $fillable = [
        'chairman',
        'committee_chairman',
        'school_physician',
        'vice_chairman',
        'corporate_secretary',
        'treasurer',
        'internal_auditor',
        'accountant'
    ];
}
