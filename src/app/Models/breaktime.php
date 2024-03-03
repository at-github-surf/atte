<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class breaktime extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'break_on', 'break_at', 'breakover_at'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
