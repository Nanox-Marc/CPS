<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Canteen;
use App\Models\roles;

class userRole extends Model
{
    use HasFactory;

    protected static $logName = 'user';

    protected $fillable = [
        'user_id',
        'role_id',
        'canteen_id',//changed column name
    ];

    public function canteen()
    {
        return $this->belongsTo(canteen::class, 'canteen_id', 'id');
    }
    public function roles()
    {
        return $this->belongsTo(roles::class, 'role_id', 'id');
    }
}
