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
        'last_name',
        'mobile_number',
        'birth_date',
        'birth_place',
        'department',
        'salary',
        'membership',
        'employment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
