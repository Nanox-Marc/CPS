<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canteen_stat extends Model
{
    use HasFactory;
    protected $table = 'canteen_stat';
    protected $fillable = [
    'status'
    ];
}
