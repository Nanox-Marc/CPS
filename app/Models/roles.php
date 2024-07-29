<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\userRole;

class roles extends Model
{
    use HasFactory;

    public function userRole()
    {
        return $this->hasMany(userRole::class,'role_id', 'id');
    }
}
