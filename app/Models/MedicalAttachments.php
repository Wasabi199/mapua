<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalAttachments extends Model
{
    use HasFactory;
    protected $fillable =[
        'image',
        'type'
    ];

    public function medical(){
        return $this->belongsTo(Medical::class);
    }
}
