<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bet extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded  = ['id'];
    protected $fillable = ['fight_id', 'user_id', 'pick','odds','amount','prize','result','bet_date','result_date'];

    public function arena(){
        return $this->belongsTo(\App\Models\Arena::class)->withTrashed();
    }

    public function fight(){
        return $this->belongsTo(\App\Models\Fight::class)->with('arena')->withTrashed();
    }

    public function affiliate(){
        return $this->belongsTo(\App\Models\User::class,'user_id','id')->withTrashed();
    }

     protected $casts = [
        'amount' => 'double',
        'prize' => 'double',
    ];
}
