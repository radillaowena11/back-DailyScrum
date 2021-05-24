<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dailyScrum extends Model
{
    protected $table = "daily_scrum";
    
    public function User() {
        return $this->belongsTo('App\User', 'id_user');
    }
}

