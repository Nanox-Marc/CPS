<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Canteen;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'cashierId',
        'canteen_id', //changed column name
        'employeeId',
        // 'employeeName',
        'amount',
        'date',
        'time',
    ];

    public function canteen ()
    {
        return $this->belongsTo(Canteen::class, 'canteen_id', 'id');
    }
}
