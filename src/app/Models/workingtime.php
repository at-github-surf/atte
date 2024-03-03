<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workingtime extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'work_on', 'working_at', 'closing_at'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
