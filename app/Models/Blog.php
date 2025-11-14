<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category; // ← Add this

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'user_id',
        'status',
        'image',
        'category_id',
    ];

}
