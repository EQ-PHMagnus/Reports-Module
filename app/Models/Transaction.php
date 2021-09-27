<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    
     protected $casts = [
        'approved_date' => 'datetime',
        'transaction_date' => 'datetime',
    ];

   public function scopeProcessed($query){
      return $query->where('status','!=', 'pending');
   }

   public function scopeUnrocessed($query){
      return $query->where('status', 'pending');
   }

   public function scopeCashIn($query){
      return $query->where('type', 'cash_in');
   }

   public function agent(){
      return $this->belongsTo(\App\Models\User::class,'user_id','id')->withTrashed(); // where role is agent
   }

   public function bet(){
      return $this->belongsTo(\App\Models\Bet::class,'bet_id','id')->withTrashed();
   }
}
