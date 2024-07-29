<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountRegistration extends Model
{
    use HasFactory;
    protected $connection = "mysql";
    protected $table = "users";
    protected $guarded = [""];

    static function isEmployeeExist($emp_id)
    {
        return DB::table('users')->where('emp_id','!=',emp_id)->get();
    }
    public function canteen()
    {
           return $this->belongsTo('App\Models\Canteen');
    }
}
