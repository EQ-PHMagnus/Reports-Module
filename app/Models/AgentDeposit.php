<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentDeposit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function agent(){
        return $this->belongsTo(\App\Models\User::class,'agent_id','id')->withTrashed(); // where role is agent
     }
}
