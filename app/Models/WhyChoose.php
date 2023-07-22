<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyChoose extends Model
{
    use HasFactory;
    protected $table = "why_chooses";
    protected $fillable = [
        "title",
        "description",
    ];
}
