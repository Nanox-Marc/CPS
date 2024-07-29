<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\userRole;
use App\Models\Transaction;

class Canteen extends Model
{
   use HasFactory;
   protected $table = 'canteen';
   protected $fillable = [
   'canteen_name',
   'status'
   ];
   public function cashier()
   {
      return $this->hasMany('App\AccountRegistration');
   }

   public function userRole()
   {
      return $this->hasMany(userRole::class,'canteen_id', 'id');
   }

   public function transaction()
   {
      return $this->hasMany(userRole::class, 'canteen_id', 'id');
   }
}
