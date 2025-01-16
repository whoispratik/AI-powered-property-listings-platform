<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    //
   use HasFactory;
   protected $fillable = ['beds','baths','area','city','code','street','street_nr','price'];
   public function user()
   {
       return $this->belongsTo(User::class);
   }
}
