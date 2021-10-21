<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fight extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $fillable = ['arena_id','fight_no','meron','meron_lb','meron_wb','meron_wt','wala','wala_lb','wala_wb','wala_wt','schedule'];

    public function arena(){
        return $this->belongsTo(\App\Models\Arena::class)->withTrashed();
    }

     /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'schedule' => 'datetime',
    ];
}
